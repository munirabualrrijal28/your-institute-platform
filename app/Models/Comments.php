<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id_fk', 'commentable_id', 'commentable_type', 'parent_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

        // ✅ NEW: Relationship to children replies
        public function replies()
        {
            return $this->hasMany(Comments::class, 'parent_id')->orderBy('created_at', 'asc');
        }

        // ✅ NEW: Relationship to parent comment (optional)
        public function parent()
        {
            return $this->belongsTo(Comments::class, 'parent_id');
        }


        //
        
}
