<?php

namespace App\Services\Admin;

use App\Models\RoadMap;
use App\Models\Road;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\RoadResource;
use Illuminate\Support\Facades\DB;

class RoadMapService
{
    public function __construct(
        public RoadMap $roadMap,
        public Road $road,
    ) {}

    public function getRoadMaps()
    {
//        $road = $this->road->with(['maps', 'maps.instanceUsers.user'])->get();

        $roads = Road::with(['roadMaps' => function ($query) {
                $query->select('road_maps.roadId',
                    'instances.id as instance_id',
                    'instances.name',
                    DB::raw("GROUP_CONCAT(u.name SEPARATOR ', ') as userNames"))
                    ->leftJoin('instances', 'road_maps.instanceId', '=', 'instances.id')
                    ->leftJoin('instance_users as iusers', 'iusers.instanceId', '=', 'instances.id')
                    ->leftJoin('users as u', 'u.id', '=', 'iusers.userId')
                    ->groupBy([
                        'road_maps.roadId', 'instances.id', 'instances.name'
                    ]);
            }])
            ->select('roads.id as id', 'roads.name as name')
            ->get();

        return $roads;

//        return RoadResource::collection($road);
    }

    public function getOne(int $roadMapId)
    {
        return $this->model->findOrFail($roadMapId);
    }

    public function store(array $data): array
    {
        $this->model->create([
            'roadId' => $data['roadId'],
            'instanceId' => $data['instanceId'],
            'stage' => $data['stage']
        ]);
        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['roadId']))
            $user->fill(['roadId' => $data['roadId']]);

        if (isset($data['instanceId']))
            $user->fill(['instanceId' => $data['instanceId']]);

        if (isset($data['stage']))
            $user->fill(['stage' => $data['stage']]);

        $user->save();

        return $user->toArray();
    }


    public function destroy(int $id)
    {
        $this->model->destroy($id);
        return $id;
    }
}
