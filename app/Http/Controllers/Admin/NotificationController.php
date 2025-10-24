<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function create_notification()
    {
        return view('admin.notification.create_notification');
        // return view('admin.manage.manage_notifications');

    }

    // The notification Manage page is accessible from admin controller
    public function markAllAsRead(Request $request)
    {
        Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }


    // public function mount()
// {
//     $this->loadNotifications();
// }





}
