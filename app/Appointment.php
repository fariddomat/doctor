<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded=[];

    public function scopeWhenUser($query,$id)
    {
        return $query->when($id,function($q) use ($id){
            return $q->where('user_id',"$id");
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
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
