<?php

namespace App\Models;

// use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ This is the correct class

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable{
    //

   use HasFactory, Notifiable;

    protected $guard = 'admin';


      use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'username',
        'password',
        'hasPermission',
        'hasBasic',
    ];

    protected $hidden = [
        'password',
    ];

    // Laravel uses 'email' by default, but since you're using 'username',
    // we tell Laravel to use that as the login field.
    public function username()
    {
        return 'username';
    }
     public function notificationsSent() {
        return $this->morphMany(Notifications::class, 'sender');
    }


public function notifications()
{
    return $this->morphMany(\App\Models\Notifications::class, 'reciver');
}
}
