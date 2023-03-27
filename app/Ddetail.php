<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ddetail extends Model
{
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
