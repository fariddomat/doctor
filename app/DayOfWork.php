<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayOfWork extends Model
{
    protected $guarded=[];

    public function daily_appointments()
    {
        return $this->hasMany(DailyAppointment::class);
    }

    public function getDsAttribute()
    {
        $dates = [];

        $start_date = new \DateTime($this->start);
        $end_date = new \DateTime($this->end);
        $interval = \DateInterval::createFromDateString('1 day');

        for ($date = $start_date; $date <= $end_date; $date->add($interval)) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
