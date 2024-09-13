<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderAction;
use App\Models\OrderRoadMapRun;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderDetailService
{
    public function __construct(
        protected Order $model
    ) {}

    public function order(int $orderId): array
    {
        return $this->model::findOrFail($orderId)->toArray();
    }


    public function orderAction(int $orderId): array
    {
        return OrderAction::select('order_actions.*', 'instances.name as instanceName', 'users.name as userName')
            ->where('orderId', $orderId)
            ->leftJoin('instances', 'instances.id', 'order_actions.instanceId')
            ->leftJoin('users', 'users.id', 'order_actions.userId')
            ->orderBy('id')->get()->toArray();
    }

    public function orderRoadMapRun(int $orderId): array
    {
        $results = OrderRoadMapRun::query()
            ->leftJoin('instances', 'instances.id', '=', 'order_road_map_runs.instanceId')
            ->select('order_road_map_runs.*', 'instances.name as instanceName', 'instances.timeLine')
            ->where('order_road_map_runs.orderId', $orderId)
            ->orderBy('order_road_map_runs.stage', 'asc')
            ->get()
            ->map(function ($orderRoadMapRun) {
                // Users IDs-ni oling va foydalanuvchi ismlarini olish
                $userIds = $orderRoadMapRun->users;
                $userNames = User::whereIn('id', $userIds)->pluck('name')->toArray();
                $orderRoadMapRun->userNames = implode(', ', $userNames);
                return $orderRoadMapRun;
            })
            ->toArray();

        return $results;
    }

}
