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
        $property_types = include database_path('data/propertyTypes.php');

        foreach($property_types as $property_type) {
            PropertyType::create($property_type);
        }
    }
}
