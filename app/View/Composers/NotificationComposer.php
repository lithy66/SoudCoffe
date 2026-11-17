<?php

namespace App\View\Composers;

use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view): void
    {
        $admin = auth('admin')->user();

        $view->with('headerNotifications', $admin ? $admin->unreadNotifications()->latest()->take(6)->get() : collect());
        $view->with('unreadNotificationsCount', $admin ? $admin->unreadNotifications()->count() : 0);
    }
}
