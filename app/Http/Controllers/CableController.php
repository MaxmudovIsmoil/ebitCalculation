<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCableRequest;
use App\Http\Requests\UpdateCableRequest;
use App\Services\CableService;
use Illuminate\Http\JsonResponse;


class CableController extends Controller
{
    public function __construct(
        public CableService $service
    ) {}

    public function getAllCount()
    {
        return $this->service->getAllCount();
    }

    public function index(?int $limit = null)
    {
        return $this->service->list($limit);
    }

    public function getOne(int $id)
    {
        return $this->service->one($id);
    }

    /**
     * @param CreateCableRequest $request
     * @return JsonResponse
     */
    public function store(CreateCableRequest $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param UpdateCableRequest $request
     * @return JsonResponse
     */
    public function update(UpdateCableRequest $request)
    {
        return $this->service->update($request->validated());
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);

    }

}
