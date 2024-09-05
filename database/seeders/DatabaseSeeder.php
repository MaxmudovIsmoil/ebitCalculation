<?php

namespace Database\Seeders;

use App\Models\Instance;
use App\Models\User;
use App\Models\Road;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => 1,
                'ldap' => '0',
                'canCreateOrder' => '0',
                'phone' => null,
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'username' => 'user',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => '0',
                'ldap' => '0',
                'canCreateOrder' => 1,
                'phone' => null,
            ]
        ]);

        Instance::insert([
            ['name' => 'Technical department'],
            ['name' => 'Head of Technical Department'],
            ['name' => 'Director of NCD'],
            ['name' => 'Finanical department'],
            ['name' => 'Finanical director'],
            ['name' => 'Director of Sales Department'],
            ['name' => 'Deputy General Director'],
            ['name' => 'General Director']
        ]);

        Road::insert([
            ['name' => "Tashkent"],
            ['name' => "Regions"]
        ]);
    }
}
