<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notifications extends Model
{
    protected $fillable = [
        'sender_id',
        'sender_type',
        'reciver_id',
        'reciver_type',
        'notification_type',
        'data',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    // 🔄 Polymorphic Sender (User | Admin | Institute)
    public function sender(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'sender_type', 'sender_id');
    }

    // 🔄 Polymorphic Receiver (User | Admin | Institute)
    public function reciver(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'reciver_type', 'reciver_id');
    }
}
