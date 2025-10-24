<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = ['user_id_fk', 'rated_id', 'type', 'rating', 'review'];

    // public function rateable()
    // {
    //     return $this->morphTo();
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    public function rateable()
{
    return $this->morphTo(__FUNCTION__, 'type', 'rated_id');
}
}
