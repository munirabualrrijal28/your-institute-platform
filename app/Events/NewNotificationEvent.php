<?php

namespace App\Events;

use App\Models\Notifications;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // optional
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;

class NewNotificationEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $notification;

    public function __construct(Notifications $notification)
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
            'data' => $this->notification->data,
            'created_at' => $this->notification->created_at->diffForHumans(),
        ];
    }


}
