<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            'dashboard',
            'reports',
            'order_command',
            'customer_master',
            'company_master',
            'procurement',
            'shop_delivery',
            'hotel_delivery',
            'assignment_dashboard',
            'sales_ledger',
            'purchase_ledger',
            'maintenance_ledger',
            'vehicles',
            'payroll',
            'financials',
        ];

        foreach ($modules as $module) {
            DB::table('modules')->updateOrInsert(
                ['slug' => $module],
                [
                    'name' => Str::title(str_replace('_', ' ', $module)),
                    'slug' => $module,
                    'icon' => null,
                    'status' => 'active',
                    'created_at' => now(),
                ]
            );
        }
    }
}
