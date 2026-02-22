<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRolesSeeder extends Seeder
{
    public function run(): void
    {
        // assign roles by email (recommended)
        
        $users = [
            'admin@example.com' => 'admin',
            'owner@example.com' => 'owner',
            'manager@example.com' => 'manager',
            'accountant@example.com' => 'accountant',
            'delivery@example.com' => 'delivery',
            'user@example.com' => 'user',
        ];

        foreach ($users as $email => $role) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->syncRoles([$role]); // replace old role
            }
        }
    }
}