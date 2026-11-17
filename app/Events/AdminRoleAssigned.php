<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Foundation\Events\Dispatchable;

class AdminRoleAssigned
{
    use Dispatchable;

    public function __construct(
        public Admin $admin,
        public string $roleName
    ) {}
}
