<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Instructor;
use App\Models\Institute;
use App\Models\Student;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
         'role',
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function institute()
    {
        return $this->hasOne(Institute::class, 'user_id_fk');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id_fk');
    }

    public function instructor()
    {
        return $this->hasOne(Instructors::class, 'user_id_fk');
    }

    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'user_id_fk');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


    public function profilePhoto()
{
    return $this->media()->where('type', 'profile_photo')->first();
}



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
