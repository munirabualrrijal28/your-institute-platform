<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_fk', 'notifiable_type', 'notifiable_id', 'type', 'data', 'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    //
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }
    //

}
