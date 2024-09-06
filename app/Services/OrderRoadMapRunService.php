<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\OrderRoadMapRun;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderRoadMapRunService
{
    public function __construct(
        protected OrderRoadMapRun $model
    ) {}

    public function getOrder(int $orderId): JsonResponse
    {
        try {
            $order = $this->model::findOrFail($orderId);
            return response()->success($order);
        } catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

}
