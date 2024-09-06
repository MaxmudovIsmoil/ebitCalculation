<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    public function __construct(
        public OrderService $service
    ) {}

    public function index(?int $limit = null)
    {
        return $this->service->list($limit);
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
        return $this->service->create($request->all());
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
