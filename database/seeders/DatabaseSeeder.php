<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            '1' => [
                'name' => 'Torpedo',
                'email' => 'diabo4694@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'moderator',
            ],
            '2' => [
                'name' => 'عماد دياب',
                'email' => 'ed8756724@gmail.com', // email for user
                'password' => Hash::make('123456789'),
                'role' => 'admin',
            ],
            '3' => [
                'name' => 'أحمد دياب',
                'email' => 'dyab4566@gmail.com', // email for user
                'password' => Hash::make('123456789'),
               
            ],
            '4' => [
                'name' => 'عمرو دياب',
                'email' => 'amrdaib697@gmail.com', // email for user
                'password' => Hash::make('123456789'),
               
            ],
            '5' => [
                'name' => 'هيثم دياب',
                'email' => 'haythemdiab5@gmail.com', // email for user
                'password' => Hash::make('123456789'),
               
            ],
            '6' => [
                'name' => 'محمد دياب',
                'email' => 'diabm4050@gmail.com', // email for user
                'password' => Hash::make('123456789'),
               
            ],
            '7' => [
                'name' => 'محمد عماد',
                'email' => 'moh.emad193551@gmail.com', // email for user
                'password' => Hash::make('123456789'),
               
            ],
            '8' => [
                'name' => 'أيمن عماد',
                'email' => 'aymanemaddiab01090@gmail.com', // email for user
                'password' => Hash::make('123456789'), 
            ],

        ];

        for($i=1; $i<=8; $i++){
           User::create($users[$i]);
        }
    }
}
