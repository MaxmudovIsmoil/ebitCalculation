<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoadStoreRequest;
use App\Http\Requests\Admin\RoadUpdateRequest;
use App\Services\Admin\RoadService;
use Illuminate\Http\JsonResponse;


class RoadController extends Controller
{
    public function __construct(
        protected RoadService $service
    ) {}

    public function index()
    {
        return view('admin.road.index');
    }

    public function getRoads()
    {
        return $this->service->getRoads();
    }

    public function getOne(int $id)
    {
        try {
            return response()->success(data: $this->service->getOne($id));
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function store(RoadStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->service->store($request->validated());
            return response()->success(data: $result);
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function update(int $id, RoadUpdateRequest $request): JsonResponse
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
