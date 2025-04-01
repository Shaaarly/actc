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

        // Generar Nombres
        Name::factory(40)->create();

        // Crear Usuarios
        $clients = User::factory(30)->client()->create();
        $owners = User::factory(3)->owner()->create();

        // Asignar propiedades a propietarios
        $properties = Property::factory(18)->create();
        foreach ($owners as $owner) {
            $owner->propertiesOwned()->attach($properties->pluck('id')->random(rand(3, 6)));
        }

        // Crear Placas para usuarios
        Plate::factory(10)->create();

        // Crear Leases entre clientes, propiedades y propietarios
        foreach ($clients as $client) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                $property = $properties->random();
                $owner = $property->owners()->inRandomOrder()->first();
                if ($owner) {
                    Lease::factory()->create([
                        'client_id' => $client->id,
                        'property_id' => $property->id,
                        'owner_id' => $owner->id,
                    ]);
                }
            }
        }

        // Cargar todos los leases para relaciones posteriores
        $leases = Lease::all();

        // Crear contratos, depósitos, pagos, notificaciones, facturas
        Contract::factory($leases->count())->create();
        Deposit::factory($leases->count())->create();
        Payment::factory(2 * $leases->count())->create();
        Notification::factory(40)->create();
        Bill::factory(40)->create();

        // Crear gastos
        Expense::factory(50)->create();

        // Crear direcciones para usuarios y propiedades
        foreach (User::all() as $user) {
            Address::factory()->forUser($user)->create();
        }
        foreach (Property::all() as $property) {
            Address::factory()->forProperty($property)->create();
        }   

        // Asignar fotos a usuarios y propiedades
        foreach (User::all() as $user) {
            $pictures = Picture::factory(2)->create();
            $user->pictures()->attach($pictures->pluck('id'));
            $user->notifications()->attach(Notification::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        }

        foreach ($properties as $property) {
            $pictures = Picture::factory(3)->create();
            $property->pictures()->attach($pictures->pluck('id'));
        }
    }

}
