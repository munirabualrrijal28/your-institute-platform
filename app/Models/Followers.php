<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{

      use HasFactory;

    protected $table = 'followers';

    protected $fillable = [
        'student_id_fk',
        'institute_id_fk',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id_fk');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id_fk');
    }
}


