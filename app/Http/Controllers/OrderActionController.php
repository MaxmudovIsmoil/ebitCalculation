<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderActionRequest;
use App\Services\OrderActionService;
use Illuminate\Http\JsonResponse;


class OrderActionController extends Controller
{
    public function __construct(
        public OrderActionService $service
    ) {}

    public function index(int $orderId)
    {
        return $this->service->list($orderId);
    }

    public function action(int $orderId, OrderActionRequest $request)
    {
        return $this->service->action($orderId, $request->validated());
    }

}
