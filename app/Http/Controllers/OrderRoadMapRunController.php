<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderRoadMapRunService;
class OrderRoadMapRunController extends Controller
{
    public function __construct(
        protected OrderRoadMapRunService $service
    ) {}

    public function index(int $orderId)
    {
        return $this->service->list($orderId);
    }
}
