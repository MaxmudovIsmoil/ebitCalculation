<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Services\Admin\UserService;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function __construct(
        public UserService $service
    ) {}

    public function index()
    {
        try {
            return response()->success(data: $this->service->getUsers());
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function getOne(int $userId)
    {
        try {
            return response()->success(data: $this->service->getOne($userId));
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }

    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            $result = $this->service->store($request->validated());
            return response()->success(data: $result);
        } catch (\Exception $e) {
            return response()->fail(error: $e->getMessage());
        }
    }

    public function update(int $id, UserUpdateRequest $request): JsonResponse
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
