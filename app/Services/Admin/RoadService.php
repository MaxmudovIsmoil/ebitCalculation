<?php

namespace App\Services\Admin;

use App\Models\Road;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class RoadService
{
    public function __construct(
        protected Road $model,
    ) {}


    public function getRoads()
    {
        $roads = $this->model->orderBy('id', 'DESC')->get()->toArray();

        return DataTables::of($roads)
            ->addIndexColumn()
            ->editColumn('id', '{{$id}}')
//            ->editColumn('status', function($road) {
//                return ($road['status'] == 1)
//                    ? '<div class="text-center"><i class="fa-solid fa-check text-success"></i></div>'
//                    : '<div class="text-center"><i class="fa-solid fa-xmark text-danger"></i></div>';
//            })
            ->addColumn('action', function ($road) {
                return '<div class="d-flex justify-content-around">
                            <a class="js_edit_btn mr-3 btn btn-outline-primary btn-sm"
                                data-update_url="'.route('admin.road.update', $road['id']).'"
                                data-one_url="'.route('admin.road.getOne', $road['id']).'"
                                href="javascript:void(0);" title="Edit">
                                <i class="fas fa-pen mr-50"></i>
                            </a>
                            <a class="js_delete_btn btn btn-outline-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-name="'.$road['name'].'"
                                data-url="'.route('admin.road.destroy', $road['id']).'"
                                href="javascript:void(0);" title="Delete">
                                <i class="far fa-trash-alt mr-50"></i>
                            </a>
                         </div>';
            })
            ->setRowClass('js_this_tr')
            ->rawColumns(['action'])
            ->setRowAttr(['data-id' => '{{ $id }}'])
            ->make();
    }

    public function getOne(int $roadId)
    {
        return $this->model->findOrFail($roadId);
    }

    public function store(array $data): array
    {
        $this->model->create([
            'name' => $data['name'],
//            'status' => $status,
        ]);

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['name']))
            $user->fill(['name' => $data['name']]);

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
