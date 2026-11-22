<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $header_title = __('notifications.notifications');

        $admin = auth('admin')->user();

        $notifications = $admin->notifications()->paginate(10);
        $unreadCount   = $admin->unreadNotifications()->count();

        return view('admin.notifications.index', compact('notifications', 'unreadCount', 'header_title'));
    }

    public function markAsRead($id)
    {
        $notification = auth('admin')->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect($notification->data['url'] ?? route('admin.dashboard'));
    }

    public function markAllAsRead()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();

        return back();
    }
}
