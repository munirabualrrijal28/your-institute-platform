<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //
   protected $fillable = ['user_id_fk', 'reportable_id', 'reportable_type', 'reason', 'description', 'status'];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }

    public function reportable()
    {
        return $this->morphTo();
    }

}
