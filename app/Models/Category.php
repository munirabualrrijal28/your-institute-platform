<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
      protected $fillable = [
        'category_name',
        'category_des' ,
        'category_photo',
        'institute_id_fk'

    ];


    public function courses() {
    return $this->hasMany(Courses::class, 'category_id_fk');
}

    public function institute()
{
    return $this->belongsTo(Institute::class , 'institute_id_fk');
}


}
