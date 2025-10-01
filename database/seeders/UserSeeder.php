<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin user
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@mie-ganas.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+6281234567890',
            'is_active' => true,
        ]);

        // Create Cashier user
        User::create([
            'name' => 'Cashier User',
            'username' => 'cashier',
            'email' => 'cashier@mie-ganas.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'phone' => '+6281234567891',
            'is_active' => true,
        ]);

        // Create Waiter user
        User::create([
            'name' => 'Waiter User',
            'username' => 'waiter',
            'email' => 'waiter@mie-ganas.com',
            'password' => Hash::make('password'),
            'role' => 'waiter',
            'phone' => '+6281234567892',
            'is_active' => true,
        ]);

        // Create Chef user
        User::create([
            'name' => 'Chef User',
            'username' => 'chef',
            'email' => 'chef@mie-ganas.com',
            'password' => Hash::make('password'),
            'role' => 'chef',
            'phone' => '+6281234567893',
            'is_active' => true,
        ]);

        // Create additional users for each role (optional)
        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'phone' => '+6281234567894',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'email' => 'janesmith@example.com',
            'password' => Hash::make('password'),
            'role' => 'waiter',
            'phone' => '+6281234567895',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Mike Johnson',
            'username' => 'mikejohnson',
            'email' => 'mikejohnson@example.com',
            'password' => Hash::make('password'),
            'role' => 'chef',
            'phone' => '+6281234567896',
            'is_active' => true,
        ]);
    }
}