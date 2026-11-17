<?php

namespace App\Listeners;

use App\Events\RolePermissionsUpdated;
use App\Services\NotificationService;
use App\Models\Admin;

class SendRolePermissionsUpdatedNotification
{
    public function handle(RolePermissionsUpdated $event): void
    {
        $admins = Admin::role($event->role->name)->get();

        NotificationService::send(
            recipients: $admins,
            type: 'role_permissions_updated',
            titleKey: 'notifications.role-permissions-updated-title',
            bodyKey: 'notifications.role-permissions-updated-body',
            bodyParams: ['role' => $event->role->name],
        );
    }
}
