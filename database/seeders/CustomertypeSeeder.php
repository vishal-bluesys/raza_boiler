<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomertypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customertype')->insert([
            [
                'typename' => 'shop',
                'typeslug' => 'shop',
                'created_at' => now(),
            ],
            [
                'typename' => 'hotel',
                'typeslug' => 'hotel',
                'created_at' => now(),
            ],
        ]);
    }
}
