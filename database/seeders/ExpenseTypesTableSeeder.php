<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExpenseType;

class ExpenseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseType::create([
            'expense_type' => 'water'
        ]);
        ExpenseType::create(['expense_type' => 'electricity']);
        ExpenseType::create(['expense_type' => 'insurance']);
        ExpenseType::create(['expense_type' => 'administrator']);
        ExpenseType::create(['expense_type' => 'iva']);
        ExpenseType::create(['expense_type' => 'ibi']);
        ExpenseType::create(['expense_type' => 'phone']);
    }
}
