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
        NotificationType::create([
            'title' => 'completed',
            'message' => 'Pago completado con éxito'
        ]);
        NotificationType::create([
            'title' => 'delayed',
            'message' => 'Pago retrasado, pendiente de pago'
        
        ]);
    }
}
