<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;



class NotificationController extends Controller
{

    // $notifications = auth()->user()->notifications()->latest()->get();

    public function index()
    {
        // $notifications = Auth::user()->notifications()->latest()->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notifications::where('id', $id)
            ->where('user_id_fk', Auth::id())
            ->firstOrFail();

        $notification->update(['read_at' => now()]);

        return redirect()->back();
    }
    //
}
