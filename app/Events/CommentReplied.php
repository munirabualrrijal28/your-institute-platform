<?php

namespace App\Events;

use App\Models\Comments;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;



class CommentReplied
{


    use InteractsWithSockets, SerializesModels;


    public $comment;

    public function __construct(Comments $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn()
    {
        // Customize the channel if needed, e.g., private or user-specific
        return new Channel('comment.notifications');
    }

    public function broadcastAs()
    {
        return 'comment.replied';
    }
}
