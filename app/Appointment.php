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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
