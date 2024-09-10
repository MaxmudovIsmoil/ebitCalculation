<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoadMapRequest;
use App\Services\Admin\RoadMapService;
use Illuminate\Http\JsonResponse;


class RoadMapController extends Controller
{
    public function __construct(
        public RoadMapService $service
    ) {}

    public function index()
    {
        $instances = $this->service->instances();
        $users = $this->service->users();

        $roads = $this->service->getRoadMaps();
        return view('admin.roadMap.index', compact('roads', 'instances', 'users'));
    }

    public function getOne(int $roadMapId): JsonResponse
    {
        try {
            return response()->success(data: $this->service->getOne($roadMapId));
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function store(RoadMapRequest $request): JsonResponse
    {
        try {
            $result = $this->service->store($request->validated());
            return response()->success(data: $result);
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function update(int $id, RoadMapRequest $request): JsonResponse
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
