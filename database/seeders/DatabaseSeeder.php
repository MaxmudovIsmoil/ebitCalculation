<?php

namespace Database\Seeders;

use App\Models\Instance;
use App\Models\InstanceUser;
use App\Models\User;
use App\Models\Road;
use App\Models\RoadMap;
use App\Models\OrderRoadMapRun;
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
                'roadId' => 1,
                'instanceId' => 2,
                'position' => 'Admin',
                'name' => 'Administrator',
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
                'roadId' => 1,
                'instanceId' => 2,
                'position' => 'User',
                'name' => 'user',
                'email' => 'user@gmail.com',
                'username' => 'user',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => '0',
                'ldap' => '0',
                'canCreateOrder' => 1,
                'phone' => null,
            ],
            [
                'roadId' => null,
                'instanceId' => 3,
                'position' => 'User2',
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'username' => 'user2',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => '0',
                'ldap' => '0',
                'canCreateOrder' => 1,
                'phone' => null,
            ],
            [
                'roadId' => null,
                'instanceId' => 4,
                'position' => 'Test',
                'name' => 'test',
                'email' => 'test@gmail.com',
                'username' => 'test',
                'password' => Hash::make(123),
                'status' => 1,
                'role' => '0',
                'ldap' => '0',
                'canCreateOrder' => 1,
                'phone' => null,
            ],
            [
                'roadId' => null,
                'instanceId' => 5,
                'position' => 'Test2',
                'name' => 'test2',
                'email' => 'test2@gmail.com',
                'username' => 'test2',
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
            ['userId' => 1, 'instanceId' => 1],
            ['userId' => 2, 'instanceId' => 2],
            ['userId' => 3, 'instanceId' => 3],
            ['userId' => 4, 'instanceId' => 4],
            ['userId' => 5, 'instanceId' => 5],
        ]);

        RoadMap::insert([
            ['roadId' => 1,'stage' => 1,'instanceId' => 2],
            ['roadId' => 1,'stage' => 2,'instanceId' => 1],
            ['roadId' => 1,'stage' => 3,'instanceId' => 5],
            ['roadId' => 1,'stage' => 4,'instanceId' => 3],

            ['roadId' => 2,'stage' => 1,'instanceId' => 1],
            ['roadId' => 2,'stage' => 2,'instanceId' => 2],
            ['roadId' => 2,'stage' => 3,'instanceId' => 4],
            ['roadId' => 2,'stage' => 4,'instanceId' => 6]
        ]);

//        Order::insert([
//            [
//                'userId' => 2,
//                'roadId' => 1,
//                'instanceId' => 1,
//                'name' => 'test',
//                'date' => date('Y-m-d'),
//                'client' => 'Client',
//                'address' => 'manzil',
//                'preliminaryCost' => "cost",
//                'contractPayment' => 'test',
//                'subscriptionFee' => 'test',
//                'monthlyPayment' => 'test',
//                'paybackPeriod' => 'test',
//                'constructionWork' => 'test',
//                'comment' => 'test comment',
//                'allStage' => 4,
//                'currentStage' => 1,
//                'currentInstanceId' => 2,
//            ],
//            [
//                'userId' => 3,
//                'roadId' => 2,
//                'instanceId' => 3,
//                'name' => 'order',
//                'date' => date('Y-m-d'),
//                'client' => 'Client',
//                'address' => 'manzil',
//                'preliminaryCost' => "cost1",
//                'contractPayment' => 'test1',
//                'subscriptionFee' => 'test1',
//                'monthlyPayment' => 'test1',
//                'paybackPeriod' => 'test1',
//                'constructionWork' => 'test1',
//                'comment' => 'test comment1',
//                'allStage' => 4,
//                'currentStage' => 1,
//                'currentInstanceId' => 1,
//            ]
//        ]);
//
//        OrderRoadMapRun::insert([
//            ['orderId' => 1, 'roadId' => 1,'stage' => 1,'instanceId' => 2, 'users' => json_encode([1, 2])],
//            ['orderId' => 1, 'roadId' => 1,'stage' => 2,'instanceId' => 1, 'users' => json_encode([3])],
//            ['orderId' => 1, 'roadId' => 1,'stage' => 3,'instanceId' => 5, 'users' => json_encode([1])],
//            ['orderId' => 1, 'roadId' => 1,'stage' => 4,'instanceId' => 3, 'users' => json_encode([4])],
//
//            ['orderId' => 2, 'roadId' => 2,'stage' => 1,'instanceId' => 1, 'users' => json_encode([2, 3])],
//            ['orderId' => 2, 'roadId' => 2,'stage' => 2,'instanceId' => 2, 'users' => json_encode([1])],
//            ['orderId' => 2, 'roadId' => 2,'stage' => 3,'instanceId' => 4, 'users' => json_encode([4])],
//            ['orderId' => 2, 'roadId' => 2,'stage' => 4,'instanceId' => 6, 'users' => json_encode([3])]
//        ]);
    }
}
