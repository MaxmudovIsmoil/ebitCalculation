<?php

namespace App\Services\Admin;

use App\Models\Instance;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class InstanceService
{
    public function __construct(
        protected Instance $model,
    ) {}


    public function getInstances()
    {
        $instances = $this->model->orderBy('id', 'DESC')->get()->toArray();

        return DataTables::of($instances)
            ->addIndexColumn()
            ->editColumn('id', '{{$id}}')
            ->editColumn('status', function($instance) {
                return ($instance['status'] == 1)
                    ? '<div class="text-center"><i class="fa-solid fa-check text-success"></i></div>'
                    : '<div class="text-center"><i class="fa-solid fa-xmark text-danger"></i></div>';
            })
            ->addColumn('action', function ($instance) {
                return '<div class="d-flex justify-content-around">
                            <a class="js_edit_btn mr-3 btn btn-outline-primary btn-sm"
                                data-update_url="'.route('admin.instance.update', $instance['id']).'"
                                data-one_url="'.route('admin.instance.getOne', $instance['id']).'"
                                href="javascript:void(0);" title="Edit">
                                <i class="fas fa-pen mr-50"></i>
                            </a>
                            <a class="js_delete_btn btn btn-outline-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-name="'.$instance['name'].'"
                                data-url="'.route('admin.instance.destroy', $instance['id']).'"
                                href="javascript:void(0);" title="Delete">
                                <i class="far fa-trash-alt mr-50"></i>
                            </a>
                         </div>';
            })
            ->setRowClass('js_this_tr')
            ->rawColumns(['status', 'action'])
            ->setRowAttr(['data-id' => '{{ $id }}'])
            ->make();
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
//            'status' => $status,
        ]);

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['name']))
            $user->fill(['name' => $data['name']]);

        if (isset($data['timeLine']))
            $user->fill(['timeLine' => $data['timeLine']]);

//        if (isset($data['status']))
//            $user->fill(['status' => $data['status']]);

        $user->save();

        return $user->toArray();
    }


    public function destroy(int $id)
    {
        $this->model->destroy($id);
        return $id;
    }
}
