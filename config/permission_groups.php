<?php

return [
    'stock' => [
        'view-stock', 'create-stock', 'edit-stock',
        'create-purchase-order', 'approve-purchase-order',
        'create-transfer', 'approve-transfer',
        'create-adjustment', 'approve-adjustment',
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
