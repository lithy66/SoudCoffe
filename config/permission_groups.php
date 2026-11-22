<?php

/*
|--------------------------------------------------------------------------
| Permission groups
|--------------------------------------------------------------------------
| المكان الوحيد اللي بتتعرّف فيه الصلاحيات. الـ Seeder وفورم الأدوار الاتنين
| بيقروا منه. أي صلاحية جديدة: ضيفها هنا + مفتاح ترجمتها في
| lang/{ar,en}/admin/permissions.php (groups و labels).
*/

return [
    'stock' => [
        'view-stock', 'create-stock', 'edit-stock',
        'create-purchase-order', 'approve-purchase-order',
        'create-transfer', 'approve-transfer',
        'create-adjustment', 'approve-adjustment',
    ],
    'warehouses' => [
        'view-warehouses', 'create-warehouse', 'edit-warehouse', 'delete-warehouse',
    ],
    'materials' => [
        'view-materials', 'create-material', 'edit-material', 'delete-material',
    ],
    'material_categories' => [
        'view-material-categories', 'create-material-category',
        'edit-material-category', 'delete-material-category',
    ],
    'units' => [
        'view-units', 'create-unit', 'edit-unit', 'delete-unit',
    ],
    'suppliers' => [
        'view-suppliers', 'create-supplier', 'edit-supplier', 'delete-supplier',
    ],
    // المنتجات + الأقسام + الأقسام الفرعية + النكهات + مستويات التحميص
    'catalog' => [
        'view-catalog', 'create-catalog', 'edit-catalog', 'delete-catalog',
    ],
    'branches' => [
        'view-branch', 'create-branch', 'edit-branch',
        'view-tables', 'manage-tables',
    ],
    'orders' => [
        'view-orders', 'create-order', 'edit-order',
        'cancel-order', 'apply-discount',
    ],
    'users' => [
        'view-users', 'create-user', 'edit-user',
        'delete-user', 'assign-roles',
    ],
    'reports' => [
        'view-reports', 'export-reports',
    ],
    'roles' => [
        'view-roles', 'create-role', 'edit-role', 'delete-role',
    ],
];
