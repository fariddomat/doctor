<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyAppointment extends Model
{
    protected $guarded=[];

    public function day_of_work()
    {
        return $this->belongsTo(DayOfWork::class);
    }
}
