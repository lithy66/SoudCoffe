<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    private const GUARD = 'admin';

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1) كل الصلاحيات المعرّفة في config/permission_groups.php
        $allPermissions = collect(config('permission_groups'))->flatten()->all();

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => self::GUARD,
            ]);
        }

        // 2) دور admin: كل الصلاحيات دايماً (بما فيها أي صلاحية اتضافت جديدة)
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => self::GUARD])
            ->syncPermissions(Permission::where('guard_name', self::GUARD)->get());

        // 3) باقي الأدوار: إعداد مبدئي بس.
        //    بتاخد صلاحياتها وقت إنشائها لأول مرة فقط، ولو الدور موجود (والأدمن عدّله
        //    من شاشة الأدوار) الـ Seeder ما بيلمسوش.
        foreach ($this->defaultRoles() as $name => $permissions) {
            $role = Role::firstOrCreate(['name' => $name, 'guard_name' => self::GUARD]);

            if ($role->wasRecentlyCreated) {
                $role->syncPermissions($permissions);
            }
        }
    }

    /**
     * كل صلاحيات مجموعة ما عدا الحذف (الحذف للأدمن بس افتراضياً).
     */
    private function manage(string $group): array
    {
        return array_values(array_filter(
            config("permission_groups.$group"),
            fn ($permission) => !str_starts_with($permission, 'delete-')
        ));
    }

    private function defaultRoles(): array
    {
        return [
            'branch manager' => [
                'view-stock', 'create-transfer',
                'view-orders', 'create-order',
                'edit-order', 'cancel-order', 'apply-discount',
                'view-branch', 'view-tables', 'manage-tables',
                'view-reports',
                'view-catalog',
            ],

            'cashier' => [
                'view-orders', 'create-order', 'view-tables',
            ],

            'warehouse keeper' => array_merge([
                'view-stock', 'create-stock', 'edit-stock',
                'create-purchase-order',
                'create-transfer', 'create-adjustment',
            ], [
                'view-warehouses', 'view-materials', 'view-units', 'view-suppliers',
            ]),

            'warehouse manager' => array_merge([
                'view-stock', 'create-stock', 'edit-stock',
                'create-purchase-order', 'approve-purchase-order',
                'create-transfer', 'approve-transfer',
                'create-adjustment', 'approve-adjustment',
                'view-reports',
            ],
                $this->manage('warehouses'),
                $this->manage('materials'),
                $this->manage('material_categories'),
                $this->manage('units'),
                $this->manage('suppliers')
            ),
        ];
    }
}
