<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //


     // Can send or receive notifications
     public function notificationsSent() {
        return $this->morphMany(Notifications::class, 'sender');
    }
}
