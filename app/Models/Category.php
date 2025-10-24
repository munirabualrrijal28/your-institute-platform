<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_des',
        'category_photo',
        'institute_id_fk'

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
    public function courses()
    {
        return $this->hasMany(Courses::class, 'category_id_fk');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id_fk');
    }


}
