<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;

    protected $fillable = ['user_id_fk'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

   public function followedInstitutes()
{
    return $this->belongsToMany(Institute::class, 'followers', 'student_id_fk', 'institute_id_fk');
}


    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

}
