<?php

namespace App\Services\Admin;

use App\Models\Road;
use Illuminate\Support\Facades\Hash;

class RoadService
{
    public function __construct(
        public Road $model,
    ) {}

    public function getRoads()
    {
        return $this->model->get();
    }

    public function getOne(int $roadId)
    {
        return $this->model->findOrFail($roadId);
    }

    public function store(array $data): array
    {
        $this->model->create(['name' => $data['name']]);
        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['name']))
            $user->fill(['name' => $data['name']]);

        if (isset($data['status']))
            $user->fill(['status' => $data['status']]);

        $user->save();

        return $user->toArray();
    }


    public function destroy(int $id)
    {
        $this->model->destroy($id);
        return $id;
    }
}
