<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_fk', 'ins_name', 'ins_description', 'ins_profile_photo', 'ins_lic_photo', 'ins_is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'institute_id_fk');
    }

    public function courseAdvs()
    {
        return $this->hasMany(CourseAdv::class, 'institute_id_fk');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisements::class, 'institute_id_fk');
    }

    public function followers()
    {
        return $this->belongsToMany(Student::class, 'followers', 'institute_id_fk', 'student_id_fk');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function ratings()
    {
        return $this->morphMany(Ratings::class, 'rateable');
    }


}
