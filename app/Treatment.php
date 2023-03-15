<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $guarded=[];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function paymentlogs()
    {
        return $this->hasMany(Paymentlog::class);
    }
}
