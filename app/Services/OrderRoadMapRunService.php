<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\OrderRoadMapRun;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderRoadMapRunService
{
    public function __construct(
        protected OrderRoadMapRun $model
    ) {}

    public function list(int $orderId): JsonResponse
    {
        try {
//            $roadData = OrderRoadMapRun::findOrFail($orderId)->toArray();
//
//            foreach ($roadData['road'] as &$road) {
//                // instance name ni olish
//                $instance = DB::table('instances')->where('id', $road['instanceId'])->first();
//                $road['instanceName'] = $instance->name ?? 'Unknown Instance';
//            }
            $roadData = OrderRoadMapRun::findOrFail($orderId)->toArray();

            // Barcha instanceId larni yig'ish
            $instanceIds = array_column($roadData['road'], 'instanceId');

            // Barcha kerakli instance ma'lumotlarini bir marta olish
            $instances = DB::table('instances')
                ->whereIn('id', $instanceIds)
                ->pluck('name', 'id'); // 'id' ni kalit qilib olamiz, 'name' esa qiymat bo'ladi


//            $userIds = array_column($roadData['road']['users'], 'users');
            // Barcha kerakli instance ma'lumotlarini bir marta olish
            $users = DB::table('users')
                ->whereIn('id', $userIds)
                ->pluck('name', 'id'); // 'id' ni kalit qilib olamiz, 'name' esa qiymat bo'ladi


            foreach ($roadData['road'] as &$road) {
                $users = DB::table('users')
                    ->whereIn('id', $road['users'])
                    ->pluck('name', 'id'); // 'id' ni kalit qilib olamiz, 'name' esa qiymat bo'ladi
                $road['instanceName'] = $instances[$road['instanceId']] ?? 'Unknown Instance';
//                $road['users']['userName'] = '';
                foreach($road['users'] as &$userId) {
                    $road['users']['userName'] .= $users[$userId].', ' ?? 'Unknown User name, ';
                }
            }
            return response()->success($roadData);
        } catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

}
