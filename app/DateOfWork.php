<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateOfWork extends Model
{
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
