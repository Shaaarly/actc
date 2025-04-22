<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'dni' => '12345678A',
            'phone' => '666666666',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'name_id' => 1,
            'role_id' => 3,
            'description' => 'user admin',
            'confirmed' => 1
        ]);
    }
}
