<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PropertyType::create(['property_type' => 'garage']);
        // PropertyType::create(['property_type' => 'storage_room']);
        // PropertyType::create(['property_type' => 'house']);
        // PropertyType::create(['property_type' => 'comercial_space']);

        $property_types = include database_path('data/propertyTypes.php');

        foreach($property_types as $property_type) {
            PropertyType::create($property_type);
        }
    }
}
