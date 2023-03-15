<?php

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
            'name'=>'Doctor',
            'email'=>'doctor@d.com',
            'password'=>bcrypt('admin'),
        ]);
        $user->attachRole('doctor');

        $user2=User::create([
            'name'=>'user',
            'email'=>'user@d.com',
            'password'=>bcrypt('user'),
        ]);
        $user2->attachRole('user');


        $user3=User::create([
            'name'=>'secr',
            'email'=>'secr@d.com',
            'password'=>bcrypt('secr'),
        ]);
        $user3->attachRole('secr');

    }
}
