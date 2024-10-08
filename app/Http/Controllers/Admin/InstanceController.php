<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InstanceStoreRequest;
use App\Http\Requests\Admin\InstanceUpdateRequest;
use App\Services\Admin\InstanceService;
use Illuminate\Http\JsonResponse;


class InstanceController extends Controller
{
    public function __construct(
        protected InstanceService $service
    ) {}

    public function index()
    {
        return view('admin.instance.index');
    }

    public function getInstances()
    {
        return $this->service->getInstances();
    }

    public function getOne(int $instanceId)
    {
        try {
            return response()->success(data: $this->service->getOne($instanceId));
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function store(InstanceStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->service->store($request->validated());
            return response()->success(data: $result);
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function update(int $id, InstanceUpdateRequest $request): JsonResponse
    {
        try {
            $result = $this->service->update($id, $request->validated());
            return response()->success(data: $result);
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }


    public function destroy(int $id)
    {
        try {
            return response()->success(data: $this->service->destroy($id));
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }
}
