<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'user_type',
        'institute_id_fk',
    ];


    protected static function booted()
    {
        static::addGlobalScope('institute_status', function ($query) {
            $query->whereHas('institute', function ($q) {
                $q->where('ins_is_verified', true)
                    ->where('is_restricted', false);
            });
        });
    }
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



