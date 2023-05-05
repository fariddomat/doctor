<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes ;
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

    public function scopeWhenStatus($query,$status)
    {
        return $query->when($status,function($q) use ($status){
            return $q->where('status','like',"%$status%" );
        });
    }


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor_appointment()
    {
        return $this->belongsTo(DoctorAppointment::class)->withTrashed();
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
