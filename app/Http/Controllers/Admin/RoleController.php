<?php

namespace App\Http\Controllers\Admin;

use App\Events\RolePermissionsUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private const GUARD = 'admin';
    private const PROTECTED_ROLE = 'admin';

    public function index()
    {
        $header_title = __('admin/roles.title');

        $roles = Role::where('guard_name', self::GUARD)
            ->withCount('permissions')
            ->orderBy('id')
            ->get();

        // عدد الأدمنز لكل رول
        $adminCounts = DB::table('model_has_roles')
            ->where('model_type', Admin::class)
            ->select('role_id', DB::raw('count(*) as total'))
            ->groupBy('role_id')
            ->pluck('total', 'role_id');

        return view('admin.roles.index', compact('roles', 'adminCounts', 'header_title'));
    }

    public function create()
    {
        $data ['header_title'] = __('admin/roles.add-role');
        $data ['groups'] = config('permission_groups');

        return view('admin.roles.add', $data);
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name'       => trim($request->name),
                'guard_name' => self::GUARD,
            ]);
            $role->syncPermissions($request->permissions ?? []);

            DB::commit();
            session()->flash('true');
            return redirect()->route('admin.roles.index')->with('success', __('general.add-s'));
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('false');
            return redirect()->back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function edit(Role $role)
    {
        $header_title = __('admin/roles.edit-role');

        $this->ensureAdminGuard($role);

        if ($this->isProtected($role)) {
            return $this->protectedResponse();
        }

        $groups = config('permission_groups');
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'groups', 'rolePermissions', 'header_title'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->ensureAdminGuard($role);

        if ($this->isProtected($role)) {
            return $this->protectedResponse();
        }

        $before = $role->permissions->pluck('name')->sort()->values()->all();

        DB::beginTransaction();
        try {
            $role->syncPermissions($request->permissions ?? []);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('false');
            return redirect()->back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }

        $after = $role->load('permissions')->permissions->pluck('name')->sort()->values()->all();

        // الإشعار يتبعت بس لو الصلاحيات اتغيرت فعلاً
        if ($before !== $after) {
            event(new RolePermissionsUpdated($role));
        }

        session()->flash('true');
        return redirect()->route('admin.roles.index')->with('success', __('general.update-s'));
    }

    public function destroy(Role $role)
    {
        $this->ensureAdminGuard($role);

        if ($this->isProtected($role)) {
            return $this->protectedResponse();
        }

        $inUse = Admin::where('role', $role->name)->exists()
            || DB::table('model_has_roles')->where('role_id', $role->id)->exists();

        if ($inUse) {
            session()->flash('false');
            return redirect()->route('admin.roles.index')->with('error', __('admin/roles.in-use'));
        }

        $role->delete();

        session()->flash('true');
        return redirect()->route('admin.roles.index')->with('success', __('admin/roles.deleted'));
    }

    private function ensureAdminGuard(Role $role): void
    {
        abort_if($role->guard_name !== self::GUARD, 404);
    }

    private function isProtected(Role $role): bool
    {
        return $role->name === self::PROTECTED_ROLE;
    }

    private function protectedResponse()
    {
        session()->flash('false');
        return redirect()->route('admin.roles.index')->with('error', __('admin/roles.protected'));
    }
}
