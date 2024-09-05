<?php

namespace App\Services\Admin;

use App\Models\Instance;
use Illuminate\Support\Facades\Hash;

class InstanceService
{
    public function __construct(
        public Instance $model,
    ) {}

    public function getInstances()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getOne(int $instanceId)
    {
        return $this->model->findOrFail($instanceId);
    }

    public function store(array $data): array
    {
        $this->model->create([
            'name' => $data['name'],
            'timeLine' => $data['timeLine'] ?? 8,
            'status' => $status,
        ]);

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['name']))
            $user->fill(['name' => $data['name']]);

        if (isset($data['timeLine']))
            $user->fill(['timeLine' => Hash::make($data['timeLine'])]);

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
