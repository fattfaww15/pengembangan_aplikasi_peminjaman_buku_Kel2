<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'John Doe',
            'nis' => '11111111',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'is_active' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Jane Smith',
            'nis' => '22222222',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'is_active' => true,
        ]);
    }
}