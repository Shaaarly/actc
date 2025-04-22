<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InsuranceType;

class InsuranceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insurance_types = include database_path('data/insuranceTypes.php');

        foreach($insurance_types as $insurance_type) {
            InsuranceType::create($insurance_type);
        }
    }
}
