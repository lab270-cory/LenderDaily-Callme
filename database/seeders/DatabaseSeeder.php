<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Timezone;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(TimezoneSeeder::class);
        $this->createUsers();
        $this->seedRoles();
    }


    private function createUsers()
    {
        User::create(['name'=>'Owner', 'email'=>'owner@owner.com',
            'password'=> Hash::make('password'), 'role_id'=>1,
            'timezone_id' => Timezone::getTimezoneId('UTC')
        ]);
    }

    private function seedRoles()
    {
        Role::updateOrCreate(['name'=> 'owner', 'display_name'=>'Owner']);
        Role::updateOrCreate(['name'=> 'admin', 'display_name'=>'Administrator']);
        Role::updateOrCreate(['name'=> 'collaborator', 'display_name'=>'Collaborator']);
    }
}
