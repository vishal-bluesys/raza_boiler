<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'mobileno' => '1111111111',
                'dob' => '1990-01-01',
                'status' => 'active',
                'password' => Hash::make('Admin@123'),
                // 'role' => 'admin',
            ],
            [
                'name' => 'Owner User',
                'username' => 'owner',
                'email' => 'owner@example.com',
                'mobileno' => '2222222222',
                'dob' => '1991-01-01',
                'status' => 'active',
                'password' => Hash::make('Owner@123'),
                // 'role' => 'owner',
            ],
            [
                'name' => 'Manager User',
                'username' => 'manager',
                'email' => 'manager@example.com',
                'mobileno' => '3333333333',
                'dob' => '1992-01-01',
                'status' => 'active',
                'password' => Hash::make('Password@123'),
                // 'role' => 'manager',
            ],
            [
                'name' => 'Delivery User',
                'username' => 'delivery',
                'email' => 'delivery@example.com',
                'mobileno' => '4444444444',
                'dob' => '1993-01-01',
                'status' => 'active',
                'password' => Hash::make('Delivery@123'),
                // 'role' => 'delivery',
            ],
            [
                'name' => 'Accountant User',
                'username' => 'accountant',
                'email' => 'accountant@example.com',
                'mobileno' => '5555555555',
                'dob' => '1994-01-01',
                'status' => 'active',
                'password' => Hash::make('Accountant@123'),
                // 'role' => 'accountant',
            ],
        ];
    
        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email']
            ], $userData);
            //$user->assignRole($userData['role']);
        }
    }
}
