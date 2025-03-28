<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Expense;
use App\Models\Name;
use App\Models\Plate;
use App\Models\Payment;
use App\Models\Deposit;
use App\Models\Notification;
use App\Models\Bill;
use App\Models\Picture;
use App\Models\Address;
use App\Models\Lease;
use App\Models\Contract;
use App\Models\Detail;

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

        Name::factory(33)->create();
        User::factory(30)->client()->create();
        User::factory(3)->owner()->create();
        Plate::factory(10)->create();
        Property::factory(10)->garage()->create();
        Property::factory(2)->house()->create();
        Property::factory(1)->comercial()->create();
        Property::factory(5)->storage()->create();
        Expense::factory(50)->create();
        Lease::factory(14)->create();
        Contract::factory(14)->create();
        Deposit::factory(14)->create();
        Payment::factory(28)->create();
        Notification::factory(28)->create();
        Detail::factory(28)->create();
        Bill::factory(28)->create();
        Address::factory(52)->create();


        // Pivote Properties_Users(Owners)
        $owners = User::where('role_id', 2)->get();
        $propert_ids = Property::pluck('id')->toArray();
        
        foreach ($owners as $owner) {
            $owner->properties()->sync($propert_ids);
        }
        
        $users = User::all();
        $notification_ids = Notification::pluck('id')->toArray();
        foreach($users as $user) {
            //Pivote Picturable_Users
            $pictures = Picture::factory()->count(2)->create();
            $user->pictures()->attach($pictures->pluck('id')->toArray());

            //Pivote Notifications_Users
            $random_notification_ids = collect($notification_ids)
                ->random(rand(1, 3))
                ->toArray();
            $user->notifications()->attach($random_notification_ids);
        }
        
        //Pivote Picturable_Properties
        $properties = Property::all();
        foreach($properties as $property) {
            $pictures = Picture::factory()->count(4)->create();
            $property->pictures()->attach($pictures->pluck('id')->toArray());
        }

    }
}
