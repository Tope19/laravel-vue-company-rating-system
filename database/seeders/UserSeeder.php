<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Tope Olotu',
                'email' => 'topeolotu75@gmail.com',
                'isAdmin' => 1,
                'password' => bcrypt('password'),
            ]
        ];

        foreach($users as $user){
            \App\Models\User::updateOrCreate($user);
        }
    }
}
