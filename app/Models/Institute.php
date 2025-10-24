<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_fk', 'ins_name', 'ins_description', 'ins_profile_photo', 'ins_lic_photo', 'ins_is_verified',
         'ins_lic_photo_approved', // Waiting for admin review
            'is_restricted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'institute_id_fk');
    }

    public function courses()
    {
        return $this->hasMany(Courses::class, 'institute_id_fk');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisements::class, 'institute_id_fk');
    }
    public function instructors()
    {
        return $this->hasMany(Instructors::class, 'institute_id_fk');
    }


    /*
🔴 This returns Student models, not the intermediate Follower records — so you cannot access .student.user from this.
    */
    // public function followers()
    // {
    //     return $this->belongsToMany(Student::class, 'followers', 'institute_id_fk', 'student_id_fk');
    // }





    public function followers()
{
    return $this->hasMany(Followers::class, 'institute_id_fk');
}

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    // public function ratings()
    // {
    //     return $this->morphMany(Ratings::class, 'rateable');
    // }

public function ratings()
{
    return $this->hasMany(Ratings::class, 'rated_id')
        ->where('type', self::class);
}
    public function admin() { return $this->belongsTo(Admin::class, 'admin_id'); }

}
