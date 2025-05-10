<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    use HasFactory;

    protected $fillable = [ 'content', 'institute_id_fk' , 'user_id' , 'user_type'];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id_fk');
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
        public function user()
    {
        return $this->morphTo(); // handles both Admin or Institute
    }
}



