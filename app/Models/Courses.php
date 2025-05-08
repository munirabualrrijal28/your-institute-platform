<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Courses extends Model
{
    //

    use HasFactory;
    public $timestamps = true;


    protected $fillable = [
        'course_name',
        'course_description' ,

        'category_id_fk',
        'institute_id_fk'
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id_fk');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id_fk');
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function ratings()
    {
        return $this->morphMany(Ratings::class, 'rateable');
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
