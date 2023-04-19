<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded=[];

    public function scopeWhenUser($query,$id)
    {
        return $query->when($id,function($q) use ($id){
            return $q->whereHas('doctor_appointment',function($q2) use ($q,$id){
                return $q2->whereHas('doctor',function($q3) use ($q2,$id){
                    return $q3->where('user_id',$id);
                });

            });
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor_appointment()
    {
        return $this->belongsTo(DoctorAppointment::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function treatment()
    {
        return $this->hasOne(Treatment::class);
    }
}
