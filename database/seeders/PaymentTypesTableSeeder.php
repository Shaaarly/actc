<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;


class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentType::create(['payment_type' => 'biweekly']);
        PaymentType::create(['payment_type' => 'monthly']);
        PaymentType::create(['payment_type' => 'quartly']);
        PaymentType::create(['payment_type' => 'biannual']);
        PaymentType::create(['payment_type' => 'annual']);
    }
}
