<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Services\OrderDetailService;
use Illuminate\Http\JsonResponse;


class OrderDetailController extends Controller
{
    public function __construct(
        protected OrderDetailService $service
    ) {}


    public function index(int $orderId)
    {
        $order = $this->service->order($orderId);

        $orderActions = $this->service->orderAction($orderId);
        $orderRoadMap = $this->service->orderRoadMapRun($orderId);

        return view('order-detail.index', compact('order', 'orderActions', 'orderRoadMap'));
    }

}
