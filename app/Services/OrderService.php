<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\Order;
use App\Models\CableChange;
use App\Models\InstanceUser;
use App\Models\OrderRoadMapRun;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected Order $model
    ) {}

    public function userInstanceIds()
    {
        return InstanceUser::where('userId', Auth::id())->pluck('instanceId')->toArray();
    }


    public function list(?int $limit = 20)
    {
        try {
            $userInstanceIds = $this->userInstanceIds();

            $orderQuery = Order::select('o.id as orderId', 'o.userId', 'o.instanceId',
                'o.allStage', 'o.status', 'o.currentStage', 'o.currentInstanceId',
                'ormr.*',
                )
                ->from('orders as o')
                ->leftJoin('order_road_map_run2s as ormr', 'ormr.orderId', '=', 'o.id')
                ->leftJoin('order_actions as oa', function ($join) {
                    $join->on('oa.orderId', '=', 'o.id');
                })
                ->with(['user', 'instance', 'currentInstance'])
                ->where(function ($query) use ($userInstanceIds) {
                    $query->where(function ($query) use ($userInstanceIds) {
                        $query->where(function ($query) use ($userInstanceIds) {
                            $query->whereIn('ormr.instanceId', $userInstanceIds)
                                ->where('ormr.stage', '<=', DB::raw('o.currentStage'));
//                        })->orWhere(function ($query) use ($userInstanceIds) {
//                            $query->whereIn('ormr.instanceId', $userInstanceIds)
//                                ->whereIn('oa.instanceId', $userInstanceIds);
                        });
                    });
//                        ->whereIn('ormr.userInstanceId', $userInstanceIds, 'or')
                });


//            if(!is_null($status)){
//                $orderQuery = $orderQuery->where(['o.status' => $status]);
//            }

            $orders = $orderQuery //->groupBy('o.id')
                ->orderBy('o.id', 'DESC')
                ->orderBy('o.currentStage', 'ASC')
                ->get();
//                ->paginate(20);

            return $orders;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function one(int $id): JsonResponse
    {
        try {
            $order = $this->model::findOrfail($id);
            return response()->success($order);
        }
        catch (\Exception $e) {
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

    public function update(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();

                if (isset($data['cable_id']) && is_numeric((int)$data['cable_id'])) {
                    $cable = $this->model::findOrFail((int)$data['cable_id']);
                    $changeData = [
                        'cable_id' => (int)$data['cable_id'],
                        'user_id' => (int)$data['user_id']
                    ];

                    if (isset($data['name'])) {
                        $changeData['old_name'] = $cable->name;
                        $changeData['new_name'] = $data['name'];
                        $cable->fill(['name' => $data['name']]);
                    }
                    if (isset($data['remain_stock'])) {
                        $changeData['old_remain_stock'] = $cable->remain_stock;
                        $changeData['new_remain_stock'] = $data['remain_stock'];
                        $cable->fill(['remain_stock' => $data['remain_stock']]);
                    }

                    if (isset($data['purpose'])) {
                        $changeData['old_purpose'] = $cable->purpose;
                        $changeData['new_purpose'] = $data['purpose'];
                        $cable->fill(['purpose' => $data['purpose']]);
                    }
                    if (isset($data['expected_delivery'])) {
                        $changeData['old_expected_delivery'] = $cable->expected_delivery;
                        $changeData['new_expected_delivery'] = $data['expected_delivery'];
                        $cable->fill(['expected_delivery' => $data['expected_delivery']]);
                    }

                    if (isset($data['applicant'])) {
                        $changeData['old_applicant'] = $cable->applicant;
                        $changeData['new_applicant'] = $data['applicant'];
                        $cable->fill(['applicant' => $data['applicant']]);
                    }

                    if (isset($data['specifiedCableLength'])) {
                        $cable->fill(['specifiedCableLength' => $data['specifiedCableLength']]);
                    }
                    CableChange::create($changeData);
                    $cable->save();
                }
            DB::commit();
            return response()->success('ok');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }


    public function destroy(int $id): JsonResponse
    {
        try {
            return response()->success($this->model::destroy($id));
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
