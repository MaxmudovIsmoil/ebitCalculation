<?php

namespace Database\Seeders;

use App\Models\Instance;
use App\Models\InstanceUser;
use App\Models\User;
use App\Models\Road;
use App\Models\RoadMap;
use App\Models\Order;
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
                'position' => 'Admin',
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => 1,
                'ldap' => '0',Admin
                'canCreateOrder' => '0',
                'phone' => null,
            ],
            [
                'position' => 'Lavozim',
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

        InstanceUser::insert([
            ['userId' => 2, 'instanceId' => 3],
            ['userId' => 2, 'instanceId' => 5],
            ['userId' => 1, 'instanceId' => 2],
            ['userId' => 2, 'instanceId' => 6],
            ['userId' => 1, 'instanceId' => 1],
        ]);
        RoadMap::insert([
            ['roadId' => 1,'stage' => 1,'instanceId' => 1],
            ['roadId' => 1,'stage' => 2,'instanceId' => 2],
            ['roadId' => 1,'stage' => 3,'instanceId' => 3],
            ['roadId' => 1,'stage' => 4,'instanceId' => 5],
            ['roadId' => 1,'stage' => 5,'instanceId' => 4],
            ['roadId' => 1,'stage' => 6,'instanceId' => 6],

            ['roadId' => 2,'stage' => 1,'instanceId' => 1],
            ['roadId' => 2,'stage' => 2,'instanceId' => 2],
            ['roadId' => 2,'stage' => 3,'instanceId' => 3],
            ['roadId' => 2,'stage' => 4,'instanceId' => 5]
        ]);

        Order::create([
            'userId' => 2,
            'roadId' => 1,
            'instanceId' => 1,
            'name' => 'test',
            'date' => date('Y-m-d'),
            'client' => 'Client',
            'address' => 'manzil',
            'materialCost' => "cost",
            'monthlyPayment' => 'test',
            'paymentDate' => 'test',
            'allStage' => 6,
            'currentStage' => 1,
            'currentInstanceId' => 2,
        ]);
    }


//['roadId' => 1,'stage' => 1,'instanceId' => 1, 'users' => [1,2]],
//['roadId' => 1,'stage' => 2,'instanceId' => 2, 'users' => [2]],
//['roadId' => 1,'stage' => 3,'instanceId' => 3, 'users' => [1]],
//['roadId' => 1,'stage' => 4,'instanceId' => 5, 'users' => [3]],
//['roadId' => 1,'stage' => 5,'instanceId' => 4, 'users' => [1]],
//['roadId' => 1,'stage' => 6,'instanceId' => 6, 'users' => [2]],

}
