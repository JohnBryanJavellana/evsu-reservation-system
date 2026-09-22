<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'firstname' => 'John Bryan',
                'middlename' => 'Argota',
                'lastname' => 'Javellana',
                'email' => 'eoms@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Administrator',
                'profile_picture' => 'avatar.png'
            ]
        ]);
    }
}
