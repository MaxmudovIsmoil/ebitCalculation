<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\Order;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected Order $model
    ) {}

    public function list(?int $limit = 20): JsonResponse
    {
        try {
            $orders = $this->model::select(
                    'orders.*',
                    'roads.name as roadName',
                    'instances.name as currentInstanceName',
                    'users.name as userName'
                )
                ->leftJoin('roads' ,'roads.id', '=', 'orders.roadId')
                ->leftJoin('instances' ,'instances.id', '=', 'orders.currentInstanceId')
                ->leftJoin('users' ,'users.id', '=', 'orders.userId')
                ->orderBy('orders.id', 'DESC')
//                ->orderBy('orders.status', 'ASC')
//                ->get();
                ->paginate($limit);

            return response()->success($orders);
        } catch (\Exception $e) {
            return response()->fail($e->getMessage());
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
