<?php

namespace App\Services\Admin;

use App\Models\RoadMap;
use App\Models\Road;
use App\Models\User;
use App\Models\Instance;
use App\Models\InstanceUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\RoadResource;
use Illuminate\Support\Facades\DB;

class RoadMapService
{
    public function __construct(
        protected RoadMap $model,
    ) {}

    public function instances(): array
    {
        return Instance::where('status', 1)->get()->toArray();
    }

    public function users()
    {
        return User::where(['role' => '0', 'status' => 1])->orderBy('id', 'DESC')->get()->toArray();
    }


    public function getRoadMaps()
    {
        $roads = Road::with(['roadMaps' => function ($query) {
                $query->select(
                    'road_maps.id',
                    'road_maps.roadId',
                    'road_maps.stage',
                    'instances.id as instance_id',
                    'instances.name',
                    DB::raw("GROUP_CONCAT(u.name SEPARATOR ', ') as userNames"))
                    ->leftJoin('instances', 'road_maps.instanceId', '=', 'instances.id')
                    ->leftJoin('instance_users as iusers', 'iusers.instanceId', '=', 'instances.id')
                    ->leftJoin('users as u', 'u.id', '=', 'iusers.userId')
                    ->groupBy([
                       'road_maps.id', 'road_maps.roadId', 'road_maps.stage', 'instances.id', 'instances.name'
                    ])
                    ->orderBy('road_maps.stage');
            }])
            ->select('roads.id as id', 'roads.name as name')
            ->orderBy('roads.id')
            ->get();

        return $roads;
    }

    public function getOne(int $roadMapId)
    {
        $roadMap = $this->model->with(['instanceUsers' => function ($query) {
            $query->select('instanceId', 'userId');
        }])->findOrFail($roadMapId);

        $userIds = $roadMap->instanceUsers->pluck('userId')->toArray();
        $roadMap->userIds = $userIds;

        return $roadMap;
    }

    public function store(array $data): string
    {
        try {
            DB::beginTransaction();
                $this->model->create([
                    'roadId' => $data['roadId'],
                    'instanceId' => $data['instanceId'],
                    'stage' => $data['stage']
                ]);

                if(!empty($data['userIds'])) {
                    InstanceUser::where('instanceId', $data['instanceId'])->delete();
                    foreach ($data['userIds'] as $userId) {
                        InstanceUser::create([
                            'instanceId' => $data['instanceId'],
                            'userId' => $userId
                        ]);
                    }
                }
            DB::commit();
            return 'ok';
        }
        catch(\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function update(int $id, array $data): string
    {
        try {
            DB::beginTransaction();
                $this->model->findOrfail($id)
                    ->update([
                        'instanceId' => $data['instanceId'],
                        'stage' => $data['stage']
                    ]);
                if(!empty($data['userIds'])) {
                    InstanceUser::where('instanceId', $data['instanceId'])->delete();
                    foreach ($data['userIds'] as $userId) {
                        InstanceUser::create([
                            'instanceId' => $data['instanceId'],
                            'userId' => $userId
                        ]);
                    }
                }
            DB::commit();
            return 'ok';
        }
        catch(\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }


    public function destroy(int $id)
    {
        $this->model->destroy($id);
        return $id;
    }

}
