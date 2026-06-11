<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([

            'role_id' => 2,

            'name' => 'Admin Tata Usaha',

            'email' => 'admin@gmail.com',

            'password' => Hash::make('password')
        ]);

        User::create([

            'role_id' => 1,

            'name' => 'Guru',

            'email' => 'guru@gmail.com',

            'password' => Hash::make('password')
        ]);

        User::create([

            'role_id' => 3,

            'name' => 'Kepala Sekolah',

            'email' => 'kepsek@gmail.com',

            'password' => Hash::make('password')
        ]);
    }
}