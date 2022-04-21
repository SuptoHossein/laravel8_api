<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = [
            ['name' => 'Supto', 'email' => 'supto@gmail.com', 'password' => '123456'],
            ['name' => 'Shakhawat', 'email' => 'shakhawat@gmail.com', 'password' => '123456'],
            ['name' => 'Shourav', 'email' => 'shourav@gmail.com', 'password' => '123456'],
            ['name' => 'Peter', 'email' => 'peter@gmail.com', 'password' => '123456'],
            ['name' => 'Sam', 'email' => 'sam@gmail.com', 'password' => '123456'],
            ['name' => 'Tony', 'email' => 'tony@gmail.com', 'password' => '123456'],
        ];

        User::insert($users);
    }
}
