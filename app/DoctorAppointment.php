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
}
