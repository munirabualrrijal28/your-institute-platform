<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class NotificationController extends Controller
{

    // $notifications = auth()->user()->notifications()->latest()->get();

    // public function index()
    // {
    //     $notifications = Notifications::where('reciver_id', Auth::id())
    //         ->where('reciver_type', \App\Models\User::class)
    //         ->latest()
    //         ->get();
    //     // $notifications = Auth::user()->notifications()->latest()->get();
    //     return view('notifications.index', compact('notifications'));
    // }

    // public function markAsRead($id)
    // {
    //     $notification = Notifications::where('id', $id)
    //         ->where('user_id_fk', Auth::id())
    //         ->firstOrFail();

    //     $notification->update(['read_at' => now()]);

    //     return redirect()->back();
    // }
    //
}
