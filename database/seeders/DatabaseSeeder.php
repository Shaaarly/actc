<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Expense;
use App\Models\Name;
use App\Models\Plate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            NamesTableSeeder::class,
            ExpenseTypesTableSeeder::class,
            NotificationTypesTableSeeder::class,
            PaymentTypesTableSeeder::class,
            RolesTableSeeder::class,
            PropertyTypesTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        User::factory(30)->client()->create();
        User::factory(3)->owner()->create();
        User::factory(1)->admin()->create();
        Property::factory(10)->garage()->create();
        Property::factory(2)->house()->create();
        Property::factory(1)->comercial()->create();
        Property::factory(5)->storage()->create();
        Expense::factory(50)->create();
        Name::factory(33)->create();
        Plate::factory(10)->create();
        Lease::factory(14)->create();
        Deposit::factory(14)->create();


    }
}
