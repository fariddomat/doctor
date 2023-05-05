<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorAppointment extends Model
{

    use SoftDeletes;
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
