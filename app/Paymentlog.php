<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentlog extends Model
{
    protected $guarded=[];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
