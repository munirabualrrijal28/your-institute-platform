<?php

namespace App\Events;

use App\Models\Admin;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class NotificationSent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->notification->reciver_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->notification->id,
            'message' => $this->notification->data['message'],
            'created_at' => $this->notification->created_at->diffForHumans(),
            'read_at' => $this->notification->read_at,
        ];
    }

    public function broadcastAs()
    {

        return 'notification.sent';
    }


    public function updateInstituteStatus($id)
    {
        $admin = Auth::user(); // Admin performing the action
        $institute = Institute::findOrFail($id);
        $user = $institute->user; // Institute's user account

        $was_verified = $institute->is_verified;
        $was_restricted = $institute->is_restricted;

        // Update status (example: unverify and restrict)
        $institute->is_verified = false; // set based on your form/request
        $institute->is_restricted = true; // set based on your form/request
        $institute->save();

        // 🔔 Notify institute about verification removal
        if ($was_verified && !$institute->is_verified) {
            $notification = Notifications::create([
                'sender_id' => $admin->id,
                'sender_type' => Admin::class,
                'reciver_id' => $user->id,
                'reciver_type' => \App\Models\User::class,
                'notification_type' => 'institute_unverified',
                'data' => ['message' => 'تم إزالة توثيق المعهد الخاص بك. يرجى التواصل مع الإدارة.'],
            ]);

            event(new NotificationSent($notification));
        }

        // 🔔 Notify institute about being restricted
        if (!$was_restricted && $institute->is_restricted) {
            $notification = Notifications::create([
                'sender_id' => $admin->id,
                'sender_type' => Admin::class,
                'reciver_id' => $user->id,
                'reciver_type' => \App\Models\User::class,
                'notification_type' => 'institute_restricted',
                'data' => ['message' => 'تم تقييد حساب المعهد الخاص بك. لا يمكنك النشر حالياً.'],
            ]);

            event(new NotificationSent($notification));
        }

        return back()->with('success', 'تم تحديث حالة المعهد.');
    }



}
