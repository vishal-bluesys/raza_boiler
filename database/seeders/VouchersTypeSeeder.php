<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VouchersTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vouchers_type')->insert([
            ['Vouchername' => 'allowance', 'created_at' => now()],
            ['Vouchername' => 'snaks', 'created_at' => now()],
            ['Vouchername' => 'meetings', 'created_at' => now()],
            ['Vouchername' => 'tea-coffee', 'created_at' => now()],
            ['Vouchername' => 'lunch', 'created_at' => now()],
            ['Vouchername' => 'dinner', 'created_at' => now()],
        ]);
    }
}
