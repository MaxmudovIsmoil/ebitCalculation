<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\OrderAction;
use App\Models\OrderRoadMapRun;
use App\Models\Order;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrderStatus;

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


    public function action(int $orderId, array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
                    $order = Order::findOrfail($orderId);
                    $this->model::create([
                        'userId' => Auth::id(),
                        'orderId' => $orderId,
                        'roadId' => $order->roadId,
                        'instanceId' => $order->currentInstanceId,
                        'stage' => $order->currentStage,
                        'status' => $data['status'],
                        'comment' => $data['comment']
                    ]);

                    if($data['status'] == OrderStatus::ACCEPTED->value) {
                        // new get currentInstanceId, stage++, status = 1, send email next users
                        if ($order->currentStage == $order->allStage) {
                            $currentStage = $order->currentStage;
                            // complated send email creator, $userId = $order->userId, currentInstanceId = $order->currentInstanceId
                            $status = 4; // Complated
                            $currentInstanceId = $order->currentInstanceId;
                            $userId = $order->userId;
                        }
                        else {
                            $status = 1; // processing
                            $currentStage = $order->currentStage + 1;
                            $currentInstanceId = $this->getNewCurrentInstanceId($orderId, $currentStage)['instanceId'];
                            // send email next users;
                            // $userIds = $this->getNewCurrentInstanceId($orderId, $currentStage)['users'];
                        }
                    }
                    else {
                        // currentInstanceId = instanceId, stage = 1, status = 3, send email creator user
                        $currentInstanceId = $order->instanceId;
                        $currentStage = 1;
                        $status = 3; // Declined
                    }

                    $order->fill([
                        'status' => $status,
                        'currentStage' => $currentStage,
                        'currentInstanceId' => $currentInstanceId,
                    ]);
                    $order->save();

            DB::commit();
            return response()->success('ok');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }


    protected function getNewCurrentInstanceId($orderId, $stage): array
    {
        return OrderRoadMapRun::select('instanceId', 'users')
            ->where(['orderId' => $orderId, 'stage' => $stage])
            ->first()
            ->toArray();
    }

}
