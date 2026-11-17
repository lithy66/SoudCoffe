<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'admin';

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $allPermissions = collect(config('permission_groups'))->flatten()->all();

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard,
            ]);
        }

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard])
            ->syncPermissions(Permission::where('guard_name', $guard)->get());

        Role::firstOrCreate(['name' => 'branch manager', 'guard_name' => $guard])
            ->syncPermissions([
                'view-stock', 'create-transfer',
                'view-orders', 'create-order',
                'edit-order', 'cancel-order', 'apply-discount',
                'view-branch', 'view-tables', 'manage-tables',
                'view-reports',
            ]);

        Role::firstOrCreate(['name' => 'cashier', 'guard_name' => $guard])
            ->syncPermissions([
                'view-orders', 'create-order', 'view-tables',
            ]);

        Role::firstOrCreate(['name' => 'warehouse keeper', 'guard_name' => $guard])
            ->syncPermissions([
                'view-stock', 'create-stock', 'edit-stock',
                'create-purchase-order',
                'create-transfer', 'create-adjustment',
            ]);

        Role::firstOrCreate(['name' => 'warehouse manager', 'guard_name' => $guard])
            ->syncPermissions([
                'view-stock', 'create-stock', 'edit-stock',
                'create-purchase-order', 'approve-purchase-order',
                'create-transfer', 'approve-transfer',
                'create-adjustment', 'approve-adjustment',
                'view-reports',
            ]);
    }
}
