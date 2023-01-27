<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded=[];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search,function($q) use ($search){
            return $q->where('name','like',"%$search%" );
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
