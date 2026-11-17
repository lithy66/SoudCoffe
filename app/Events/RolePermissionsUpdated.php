<?php

namespace App\Events;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Events\Dispatchable;

class RolePermissionsUpdated
{
    use Dispatchable;

    public function __construct(
        public Role $role
    ) {}
}
