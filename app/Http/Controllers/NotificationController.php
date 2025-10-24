<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    // public function markAllAsRead(Request $request)
    // {
    //     Notifications::where('reciver_id', Auth::id())
    //         ->where('reciver_type', \App\Models\User::class)
    //         ->whereNull('read_at')
    //         ->update(['read_at' => now()]);

    //     return response()->json(['success' => true]);
    // }



    // public function markAsRead($id)
    // {
    //     $notification = Notifications::where('reciver_id', Auth::id())
    //         ->where('reciver_type', \App\Models\User::class)
    //         ->findOrFail($id);

    //     $notification->update(['read_at' => now()]);

    //     return response()->json(['status' => 'success']);
    // }

}
