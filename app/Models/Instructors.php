<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Instructors extends Model
{

    //
     protected $fillable = [
        'institute_id',
        'name',
        'email',
        'Image_url',
        'bio',
    ];

    /**
     * المعهد الذي ينتمي إليه المدرب
     */
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institute_id_fk');
    }

    /**
     * المستخدم المرتبط بهذا المدرب (تسجيل الدخول)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    /**
     * الوسائط المرتبطة بالمدرب (صور، سيرة ذاتية مرفقة، إلخ)
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * التقييمات التي حصل عليها المدرب
     */
    public function ratings(): MorphMany
    {
        return $this->morphMany(Ratings::class, 'rateable');
    }

}
