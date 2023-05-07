<?php

use App\Doctor;
use App\Patient;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user0 = User::create([
            'name' => 'Admin',
            'email' => 'admin@d.com',
            'password' => bcrypt('admin'),
        ]);

        $role0 = Role::create(['name' => 'admin']);
        $user0->assignRole($role0);

        $user = User::create([
            'name' => 'Leen',
            'email' => 'doctor@d.com',
            'password' => bcrypt('admin'),
        ]);


        $role = Role::create(['name' => 'doctor']);
        $user->assignRole($role);

        Doctor::create([
            'user_id' => $user->id,
            'spec' => 'spec',
            'qout' => 'qout',
            'img' => 'GkRr76fIWHFkoBDbh3rz0i8ydM84U87SCVob4fpn.jpg'
        ]);

        $user4 = User::create([
            'name' => 'Ammar',
            'email' => 'ammar@d.com',
            'password' => bcrypt('admin'),
        ]);

        $user4->assignRole($role);

        Doctor::create([
            'user_id' => $user4->id,
            'spec' => 'spec',
            'qout' => 'qout',
            'img' => '5QJaKMfjbFPJLizhsCtLILGvUe1PGmeJdPm2bdVJ.jpg'
        ]);

        $user2 = User::create([
            'name' => 'user',
            'email' => 'user@d.com',
            'password' => bcrypt('user'),
        ]);

        $role2 = Role::create(['name' => 'user']);
        $user2->assignRole($role2);
        Patient::create([
            'user_id' => $user2->id
        ]);


        $user3 = User::create([
            'name' => 'secr',
            'email' => 'secr@d.com',
            'password' => bcrypt('secr'),
        ]);

        $role3 = Role::create(['name' => 'secr']);
        $user3->assignRole($role3);
    }
}
