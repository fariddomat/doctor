<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function daily_appointment()
    {
        return $this->belongsTo(DailyAppointment::class);
    }
}
