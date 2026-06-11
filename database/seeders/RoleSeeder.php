<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([

            [
                'name' => 'Guru',
                'slug' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Tata Usaha',
                'slug' => 'tata_usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Kepala Sekolah',
                'slug' => 'kepala_sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}