<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NotificationType::create([
        //     'title' => 'completed',
        //     'message' => 'Pago completado con éxito'
        // ]);
        // NotificationType::create([
        //     'title' => 'delayed',
        //     'message' => 'Pago retrasado, pendiente de pago'
        
        // ]);

        $notification_types = include database_path('data/notificationTypes.php');

        foreach($notification_types as $notification_type) {
            NotificationType::create($notification_type);
        }
    }
}
