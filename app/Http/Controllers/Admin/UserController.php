<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
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
        $roads = $this->service->roads();
        $instances = $this->service->instances();

        return view('admin.user.index', compact('roads', 'instances'));
    }

    public function getUsers()
    {
        return $this->service->getUsers();
    }

    public function getOne(int $id)
    {
        try {
            return response()->success($this->service->one($id));
        }
        catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            $user = $this->service->store($request->validated());
            return response()->success($user);
        }
        catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $result = $this->service->update($request->validated(), $id);
            return response()->success($result);
        }
        catch(\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            return response()->success($this->service->destroy($id));
        }
        catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }
}
