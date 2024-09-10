<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderFileService;

class OrderFileController extends Controller
{
    public function __construct(
        protected OrderFileService $service
    ) {}

    public function index(int $orderId)
    {
        return $this->service->getFiles($orderId);
    }

    public function store(OrderFileStoreRequet $request)
    {
        return $this->service->store($request->validated());
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }

}
