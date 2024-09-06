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
        return $this->service->list($orderId);
    }

}
