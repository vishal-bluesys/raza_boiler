<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaitainancetypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('maitainancetype')->insert([
            ['maintanancetype' => 'fuel', 'created_at' => now()],
            ['maintanancetype' => 'Breakdown', 'created_at' => now()],
        ]);
    }
}
