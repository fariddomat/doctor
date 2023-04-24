<?php

use App\Doctor;
use App\Patient;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user0=User::create([
            'name'=>'Admin',
            'email'=>'admin@d.com',
            'password'=>bcrypt('admin'),
        ]);
        $user0->attachRole('admin');

        $user=User::create([
            'name'=>'Leen',
            'email'=>'doctor@d.com',
            'password'=>bcrypt('admin'),
        ]);
        $user->attachRole('doctor');
        Doctor::create([
            'user_id'=>$user->id,
            'spec'=>'spec',
            'qout'=>'qout',
            'img'=>'H9XbJ3ayHtT7082efDteEv1XCuHZYq1ePeTeYzZE.jpg'
        ]);

        $user4=User::create([
            'name'=>'Ammar',
            'email'=>'ammar@d.com',
            'password'=>bcrypt('admin'),
        ]);
        $user4->attachRole('doctor');
        Doctor::create([
            'user_id'=>$user4->id,
            'spec'=>'spec',
            'qout'=>'qout',
            'img'=>'CuZUrjpejXLo8QwpFZV9s4NwvUW8PkkGCNJpbFaV.jpg'
        ]);

        $user2=User::create([
            'name'=>'user',
            'email'=>'user@d.com',
            'password'=>bcrypt('user'),
        ]);
        $user2->attachRole('user');
        Patient::create([
            'user_id'=>$user2->id
        ]);


        $user3=User::create([
            'name'=>'secr',
            'email'=>'secr@d.com',
            'password'=>bcrypt('secr'),
        ]);
        $user3->attachRole('secr');

    }
}
