<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\RoadMap;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {}

    public function index(int $status = null)
    {
        $userInstanceIds = $this->service->userInstanceIds();

        $allOrders = $this->service->getOrders();
        $orderProcessing = $this->service->getOrders(1);
        $orderDeclined = $this->service->getOrders(3);
        $orderCompleted = $this->service->getOrders(4);

        return view('order.index', compact(
            'allOrders',
            'orderProcessing',
            'orderDeclined',
            'orderCompleted',
            'userInstanceIds'
        ));
    }

    public function getOne(int $id)
    {
        return $this->service->one($id);
    }

    /**
     * @param OrderStoreRequest $request
     * @return JsonResponse
     */
    public function store(OrderStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * @param OrderUpdateRequest $request
     * @return JsonResponse
     */
    public function update(OrderUpdateRequest $request)
    {
        return $this->service->update($request->validated());
    }

//    public function destroy(int $id)
//    {
//        return $this->service->destroy($id);
//    }

}
