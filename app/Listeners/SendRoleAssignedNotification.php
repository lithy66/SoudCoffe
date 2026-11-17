<?php

namespace App\Listeners;

use App\Events\AdminRoleAssigned;
use App\Services\NotificationService;

class SendRoleAssignedNotification
{
    public function handle(AdminRoleAssigned $event): void
    {
        NotificationService::send(
            recipients: $event->admin,
            type: 'role_assigned',
            titleKey: 'notifications.role-assigned-title',
            bodyKey: 'notifications.role-assigned-body',
            bodyParams: ['role' => $event->roleName],
        );
    }
}
