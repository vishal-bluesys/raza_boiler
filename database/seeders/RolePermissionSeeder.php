<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [
            'view',
            'create',
            'edit',
            'delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $owner = Role::firstOrCreate(['name' => 'owner']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $delivery = Role::firstOrCreate(['name' => 'delivery']);
        $accountant = Role::firstOrCreate(['name' => 'accountant']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $owner->givePermissionTo(['view', 'create', 'edit']);
        $user->givePermissionTo(['view']);
    }
}
