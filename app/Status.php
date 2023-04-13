<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded=[];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
