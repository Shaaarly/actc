<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     Role::create(['role_name' => 'client']);
    //     Role::create(['role_name' => 'owner']);
    //     Role::create(['role_name' => 'admin']);

        $role_names = include database_path('data/roles.php');

        foreach($role_names as $role_name) {
            Role::create($role_name);
        }
    }
}
