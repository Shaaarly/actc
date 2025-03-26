<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Name;

class NamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Name::create([
            'name' => 'Carles',
            'surname_first' => 'Tur',
            'surname_second' => 'Cardona'
        ]);
    }
}
