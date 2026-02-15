<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicletypemasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehicletypemaster')->insert([
            ['vehicletype' => 'big', 'created_at' => now()],
            ['vehicletype' => 'small', 'created_at' => now()],
            ['vehicletype' => 'two wheeler', 'created_at' => now()],
            ['vehicletype' => 'three wheeler', 'created_at' => now()],
            ['vehicletype' => 'four wheeler', 'created_at' => now()],
        ]);
    }
}
