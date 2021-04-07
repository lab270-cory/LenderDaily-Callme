<?php

namespace Database\Seeders;

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
        $this->call(TimezoneSeeder::class);
//        $this->createUsers();
    }

    public function createUsers()
    {
        User::create(['name'=>'Name', 'email'=>'admin@admin.com', 'password'=> Hash::make('password')]);
    }
}
