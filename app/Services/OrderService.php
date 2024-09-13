<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\Order;
use App\Models\OrderFile;
use App\Models\RoadMap;
use App\Models\CableChange;
use App\Models\InstanceUser;
use App\Models\OrderRoadMapRun;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\FileTrait;

class OrderService
{
    use FileTrait;

    public function __construct(
        protected Order $model
    ) {}

    public function userInstanceIds(): array
    {
        return InstanceUser::where('userId', Auth::id())->pluck('instanceId')->toArray();
    }


    public function getOrders(int $status = null)
    {
        try {
            $userInstanceIds = $this->userInstanceIds();

            $orderQuery = $this->model::leftJoin('order_road_map_runs AS ormr', 'ormr.orderId', '=', 'o.id')
                ->leftJoin('order_actions AS oa', 'oa.orderId', '=', 'o.id')
                ->leftJoin('instances AS i', 'i.id', '=', 'o.instanceId')
                ->leftJoin('instances AS inst', 'inst.id', '=', 'o.currentInstanceId')
                ->leftJoin('users AS u', 'u.id', '=', 'o.userId')
                ->select(
                    'o.id',
                    'o.userId',
                    'o.currentInstanceId',
                    'o.allStage',
                    'o.currentStage',
                    'o.client',
                    'o.address',
                    'o.date',
                    'o.comment',
                    'o.created_at',
                    'o.status',
                    'u.name AS userName',
                    'i.name AS instanceName',
                    'inst.name AS currentInstanceName'
                )
                ->from('orders as o')
                ->where(function($query) use ($userInstanceIds) {
                    $query->where(function($subQuery) use ($userInstanceIds) {
                        $subQuery->whereIn('ormr.instanceId', $userInstanceIds)
                            ->whereColumn('ormr.stage', '<=', 'o.currentStage');
                    })->orWhere(function($subQuery) use ($userInstanceIds) {
                        $subQuery->whereIn('ormr.instanceId', $userInstanceIds)
                            ->whereIn('oa.instanceId', $userInstanceIds);
                    })->orWhereIn('ormr.instanceId', $userInstanceIds);
                });

            $orderQuery = $status ? $orderQuery->where('o.status', $status) : $orderQuery;

            $orders = $orderQuery->groupBy(
                'o.id',
                'u.name',
                'i.name',
                'inst.name',
                'o.userId',
                'o.instanceId',
                'o.currentInstanceId',
                'o.allStage',
                'o.currentStage',
                'o.status',
                'o.client',
                'o.address',
                'o.date',
                'o.comment',
                'o.created_at',
            )
            ->orderBy('o.id', 'DESC')
            ->orderBy('o.currentStage', 'ASC')
            ->paginate(3);

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

    public function store(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();

                $roadId = Auth::user()->roadId;
                $roadMapCount = RoadMap::where('roadId', $roadId)->count();
                $currentInstanceId = RoadMap::where(['roadId' => $roadId, 'stage' => 2])->first()->instanceId;

                $orderId = $this->model::insertGetId([
                    'roadId' => $roadId,
                    'userId' => Auth::id(),
                    'instanceId' => Auth::user()->instanceId,
                    'date' => $data['date'],
                    'client' => $data['client'],
                    'address' => $data['address'],
                    'preliminaryCost' => $data['preliminaryCost'],
                    'contractPayment' => $data['contractPayment'],
                    'subscriptionFee' => $data['subscriptionFee'],
                    'monthlyPayment' => $data['monthlyPayment'],
                    'paybackPeriod' => $data['paybackPeriod'],
                    'constructionWork' => $data['constructionWork'],
                    'comment' => $data['comment'] ?? "",
                    'currentStage' => 2,
                    'allStage' => $roadMapCount,
                    'currentInstanceId' => $currentInstanceId
                ]);

                $this->orderRoadMapRunSave($orderId, $roadId);

//                $this->uploadFiles($data['files']);

            DB::commit();
            return response()->success('ok');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    protected function orderRoadMapRunSave(int $orderId, int $roadId): void
    {
        $roadMaps = RoadMap::with(['instanceUsers' => function ($query) {
                $query->select('instanceId', 'userId');
            }])
            ->where('roadId', $roadId)
            ->get()
            ->map(function ($roadMaps) {
                $roadMaps->instanceUsers = $roadMaps->instanceUsers->pluck('userId')->toArray();
                return $roadMaps;
            })
            ->toArray();

        foreach($roadMaps as $roadMap) {
            OrderRoadMapRun::create([
                'orderId' => $orderId,
                'roadId' => $roadId,
                'stage' => $roadMap['stage'],
                'instanceId' => $roadMap['instanceId'],
                'users' => $roadMap['instanceUsers'],
            ]);
        }
    }


    public function update(int $id, array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
                $order = $this->model::findOrFail($id);
                $resendStatus = null;
                if (isset($data['date'])) {
                    $changeData['oldDate'] = $order->date;
                    $changeData['newDate'] = $data['date'];
                    $order->fill(['name' => $data['name']]);
                    $resendStatus = 1;
                }
                if (isset($data['client'])) {
                    $changeData['oldClient'] = $order->client;
                    $changeData['newClient'] = $data['client'];
                    $order->fill(['client' => $data['client']]);
                    $resendStatus = 1;
                }

                if (isset($data['preliminaryCost'])) {
                    $changeData['oldPreliminaryCost'] = $order->preliminaryCost;
                    $changeData['newPreliminaryCost'] = $data['preliminaryCost'];
                    $order->fill(['preliminaryCost' => $data['preliminaryCost']]);
                    $resendStatus = 1;
                }
                if (isset($data['contractPayment'])) {
                    $changeData['oldContractPayment'] = $order->contractPayment;
                    $changeData['newContractPayment'] = $data['contractPayment'];
                    $order->fill(['contractPayment' => $data['contractPayment']]);
                    $resendStatus = 1;
                }

                if (isset($data['subscriptionFee'])) {
                    $changeData['oldSubscriptionFee'] = $order->subscriptionFee;
                    $changeData['newSubscriptionFee'] = $data['subscriptionFee'];
                    $order->fill(['subscriptionFee' => $data['subscriptionFee']]);
                    $resendStatus = 1;
                }

                if (isset($data['monthlyPayment'])) {
                    $changeData['oldMonthlyPayment'] = $order->monthlyPayment;
                    $changeData['newMonthlyPayment'] = $data['monthlyPayment'];
                    $order->fill(['monthlyPayment' => $data['monthlyPayment']]);
                    $resendStatus = 1;
                }

                if (isset($data['paybackPeriod'])) {
                    $changeData['oldPaybackPeriod'] = $order->paybackPeriod;
                    $changeData['newaybackPeriod'] = $data['paybackPeriod'];
                    $order->fill(['paybackPeriod' => $data['paybackPeriod']]);
                    $resendStatus = 1;
                }

                if (isset($data['constructionWork'])) {
                    $changeData['oldConstructionWork'] = $order->constructionWork;
                    $changeData['newConstructionWork'] = $data['constructionWork'];
                    $order->fill(['constructionWork' => $data['constructionWork']]);
                    $resendStatus = 1;
                }
                if (isset($data['comment'])) {
                    $changeData['oldComment'] = $order->comment;
                    $changeData['newComment'] = $data['comment'];
                    $order->fill(['comment' => $data['comment']]);
                    $resendStatus = 1;
                }

                $order->fill(['resendStatus' => $resendStatus]);
                $order->save();

                OrderUpdated::create($changeData);

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
