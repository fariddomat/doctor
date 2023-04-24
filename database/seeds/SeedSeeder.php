<?php

use App\DailyAppointment;
use App\DayOfWork;
use App\Type;
use Illuminate\Database\Seeder;

class SeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=['Bleaching teeth', 'tooth extraction', 'Tooth filling', 'Caries treatment', 'Other'];
        foreach ($types as $key => $type) {
            Type::create([
                'name' => $type,
                'description' => $type,
                'price' => 50,
            ]);
        }

        $dayes=['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
        foreach ($dayes as $key => $day) {
            $dayofWork=DayOfWork::create([
                'day'=> $day
            ]);
            if($key==0){
                for ($i=strtotime("14:00"); $i <= strtotime("18:00");  $i+=1800 ) {
                    DailyAppointment::create([
                        'day_of_work_id'=> $dayofWork->id,
                        'time'=> date('g:i', $i),
                    ]);
                }
            }else{
                for ($i=strtotime("10:00"); $i <= strtotime("16:00");  $i+=1800 ) {
                    DailyAppointment::create([
                        'day_of_work_id'=> $dayofWork->id,
                        'time'=> date('g:i', $i),
                    ]);
                }
            }

        }
    }
}
