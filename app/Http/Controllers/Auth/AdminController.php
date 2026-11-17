<?php

namespace App\Http\Controllers\Auth;

use App\Events\AdminRoleAssigned;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\UserProfile;
use App\Models\Warehouse;
use App\Services\TwoFactorService;
use App\Traits\UploadImageTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        $data['header_title'] = __('sign in');
        return view('admin.auth.signin', $data);
    }

    public function postLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)){
            session()->flash('false');
            return redirect()->back()->with('error', __('messages.too many attempts', ['seconds' => RateLimiter::availableIn($throttleKey),]));
        }

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            RateLimiter::clear($throttleKey);
            if (auth()->guard('admin')->user()->is_active == 0)
            {
                auth()->guard('admin')->logout();
                return redirect(url('/'));
            }
            session()->flash('login');
            return redirect()->route('admin.dashboard');
        }
        RateLimiter::hit($throttleKey, 60);
        session()->flash('false');
        return redirect()->back()->with('error', __('messages.check login error'));
    }

    public function AccountList()
    {
        $data['admins'] =  Admin::getAdmin();
        $data['header_title'] = __('auth.admin-list');
        return view('admin.auth.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = "Register Admin Account";
        $data['branches'] = Branch::active();
        $data['warehouses'] = Warehouse::active();
        $data['roles'] = Role::where('guard_name', 'admin')->get();
        return view('admin.auth.sign-up', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param AdminRegisterRequest $request
     * @return RedirectResponse
     */
    public function store(AdminRegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $admin = new Admin;
            $admin->name = trim($request->name);
            $admin->email = trim($request->email);
            $admin->phone = trim($request->phone);
            $admin->password = Hash::make($request->password);
            $admin->role = trim($request->role);
            $admin->branch_id = $request->branch_id;
            $admin->warehouse_id = $request->warehouse_id;
            $admin->is_active = 1;
            $admin->save();
            $admin->assignRole($request->role);


            $profile = new UserProfile;
            $profile->admin_id = $admin->id;
            $profile->national_id = $request->national_id;
            $profile->birth_date = $request->birth_date;
            $profile->gender = $request->gender;
            $profile->address = $request->address;
            $profile->emergency_contact = $request->emergency_contact;
            $profile->hire_date = $request->hire_date;
            $profile->salary = $request->salary;
            $profile->notes = $request->notes;
            $profile->save();

            $this->upload($request, 'photo', 'Admins', 'upload_image', $admin->id, Admin::class);

            DB::commit();
        }catch (\Throwable $ex){
            DB::rollBack();
            report($ex);
            session()->flash('false');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }

        AdminRoleAssigned::dispatch($admin, $request->role);
            session()->flash('true');
            return redirect()->route('admin.account.admin-list')->with('success', 'Admin successfully created');
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $data['admin'] = Admin::singleAdmin($id);
        $data['branches'] = Branch::active();
        $data['warehouses'] = Warehouse::active();
        $data['roles'] = Role::where('guard_name', 'admin')->pluck('name', 'name');
        if (!empty($data['admin']))
        {
            $data['header_title'] = __('auth.edit profile');
            return view('admin.auth.edit-profile', $data);
        }
            return abort(404);
    }

    /**
     * Update the specified resource in storage.
     * @param AdminRegisterRequest $request
     * @param string $id
     * @return RedirectResponse
     */

    public function update(AdminRegisterRequest $request, $id)
    {
        $admin   = Admin::findOrFail($id);
        $current = auth('admin')->user();
        $newRole = trim($request->role);

        // هل المطلوب تغيير فعلي في الدور؟
        $roleChanged = $admin->role !== $newRole;
        // هل لازم نزامن Spatie؟ (تغيير فعلي، أو أدمن قديم ملوش رول في Spatie)
        $needsSync = $roleChanged || !$admin->hasRole($newRole);

        if ($roleChanged) {
            // 1) لازم يكون عنده صلاحية تعيين الأدوار
            abort_unless($current->can('assign-roles'), 403);

            // 2) دور admin ميعيّنوش غير admin
            abort_if($newRole === 'admin' && !$current->hasRole('admin'), 403);

            // 3) ميغيّرش دور نفسه
            if ($admin->id === $current->id) {
                return redirect()->back()->withInput()
                    ->withErrors(['role' => __('admin/roles.cannot-change-own-role')]);
            }

            // 4) ميشيلش آخر admin فعّال في النظام
            $isLastAdmin = $admin->role === 'admin'
                && !Admin::where('role', 'admin')
                    ->where('is_active', 1)
                    ->where('id', '!=', $admin->id)
                    ->exists();

            if ($isLastAdmin) {
                return redirect()->back()->withInput()
                    ->withErrors(['role' => __('admin/roles.last-admin')]);
            }
        }

        DB::beginTransaction();

        try {
            $admin->name = trim($request->name);
            $admin->email = trim($request->email);
            $admin->phone = trim($request->phone);
            if (!empty($request->password))
            {
                $admin->password = Hash::make($request->password);
                $admin->must_change_password = $admin->id !== auth('admin')->id();
                app(TwoFactorService::class)->revokeDevices($admin);
            }
            $admin->role = $newRole;
            $admin->branch_id = $request->branch_id;
            $admin->warehouse_id = $request->warehouse_id;
            $admin->save();

            if ($needsSync) {
                $admin->syncRoles([$newRole]);
            }

            $profile = UserProfile::firstOrNew(['admin_id' => $admin->id]);
            $profile->admin_id = $admin->id;
            $profile->national_id = $request->national_id;
            $profile->birth_date = $request->birth_date;
            $profile->gender = $request->gender;
            $profile->address = $request->address;
            $profile->emergency_contact = $request->emergency_contact;
            $profile->hire_date = $request->hire_date;
            $profile->salary = $request->salary;
            $profile->notes = $request->notes;
            $profile->save();

            if ($request->has('photo')){
                $this->Delete_attachment($admin->id, Admin::class, 'upload_image');
                $this->upload($request, 'photo', 'Admins', 'upload_image', $id, Admin::class);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.account.admin-list')->withErrors(['error' => $exception->getMessage()]);
        }

        // الإشعار بعد الـ commit، عشان ميتبعتش لو الحفظ فشل
        if ($roleChanged) {
            AdminRoleAssigned::dispatch($admin, $newRole);
        }

        session()->flash('true');
        return redirect(route('admin.account.admin-list'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $admin = Admin::singleAdmin($id);

        $admin->is_active = 0;
        $admin->save();

        session()->flash('true');
        return redirect()->route('admin.account.admin-list')->with('success', __('general.update-s'));
    }

    public function recover($id)
    {
        $admin = Admin::singleAdmin($id);

        $admin->is_active = 1;
        $admin->save();

        session()->flash('true');
        return redirect()->route('admin.account.admin-list')->with('success', __('general.update-s'));
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::invalidate();
        session::regenerateToken();
        session()->flash('logout');
        return redirect()->route('admin.login');
    }
}
