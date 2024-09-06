<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\OrderAction;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderActionService
{
    public function __construct(
        protected OrderAction $model
    ) {}

    public function list(int $orderId): JsonResponse
    {
        try {
            $orderAction = OrderAction::select(
                    'roads.name as roadName',
                    'instances.name as instanceName',
                    'users.name as userName',
                    'order_actions.*'
                )
                ->leftJoin('roads', 'roads.id', '=', 'order_actions.roadId')
                ->leftJoin('instances', 'instances.id', '=', 'order_actions.instanceId')
                ->leftJoin('users', 'users.id', '=', 'order_actions.userId')
                ->orderBy('stage')
                ->get();

            return response()->success($orderAction);

        } catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }


    public function create(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
                foreach ($data as $item) {
                    $this->model::create([
                        'user_id' => $item['user_id'],
                        'name' => $item['name'],
                        'remain_stock' => $item['remain_stock'],
                        'purpose' => $item['purpose'],
                        'expected_delivery' => $item['expected_delivery'] ?? '',
                        'applicant' => $item['applicant'] ?? "",
                        'specifiedCableLength' => $item['specifiedCableLength'] ?? "",
                    ]);
                }
            DB::commit();
            return response()->success('ok');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }


}
