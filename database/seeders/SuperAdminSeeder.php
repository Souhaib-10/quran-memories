<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Super Admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'quran_kuttab@gmail.com',
            'password' => bcrypt('Quran_memorize@2024'),
            'role' => 'superAdmin',
        ]);
    }
}
