<?php

namespace App\Services\Admin;

use App\Jobs\SendEmailAdminUpdateJob;
use App\Models\User;
use App\Models\Road;
use App\Models\Instance;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

class UserService
{
    public function __construct(
        protected User $model
    ) {}

    public function instances(): array
    {
        return Instance::where('status', 1)->get()->toArray();
    }

    public function roads(): array
    {
        return Road::get()->toArray();
    }

    public function getUsers()
    {
        $users = $this->model->orderBy('id', 'DESC')->get()->toArray();

        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('id', '{{$id}}')
            ->editColumn('status', function($user) {
                return ($user['status'] == 1)
                    ? '<div class="text-center"><i class="fa-solid fa-check text-success"></i></div>'
                    : '<div class="text-center"><i class="fa-solid fa-xmark text-danger"></i></div>';
            })
            ->editColumn('ldap', function($user) {
                return ($user['ldap'] == 1)
                    ? '<div class="text-center"><i class="fa-solid fa-check text-success"></i></div>'
                    : '<div class="text-center"><i class="fa-solid fa-xmark text-danger"></i></div>';
            })

            ->addColumn('action', function ($user) {
                $deleteBtn = '<a class="js_delete_btn btn btn-outline-danger btn-sm"
                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-name="'.$user['name'].'"
                                data-url="'.route('admin.user.destroy', $user['id']).'"
                                href="javascript:void(0);" title="Delete">
                                <i class="far fa-trash-alt mr-50"></i>
                            </a>';
                if ($user['id'] == 1)
                    $deleteBtn = '<p class="text-center m-0" style="color: darkred;"><i class="fa-solid fa-lock"></i></p>';

                return '<div class="d-flex justify-content-around">
                            <a class="js_edit_btn mr-3 btn btn-outline-primary btn-sm"
                                data-update_url="'.route('admin.user.update', $user['id']).'"
                                data-one_url="'.route('admin.user.getOne', $user['id']).'"
                                href="javascript:void(0);" title="Edit">
                                <i class="fas fa-pen mr-50"></i>
                            </a>'.$deleteBtn.'</div>';
            })
            ->setRowClass('js_this_tr')
            ->rawColumns(['status', 'ldap', 'language', 'action'])
            ->setRowAttr(['data-id' => '{{ $id }}'])
            ->make();
    }


    public function one(int $id)
    {
         return $this->model::findOrFail($id);
    }

    public function store(array $data): string
    {
        try  {
            $this->model::create([
                'position' => $data['position'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'username' => $data['username'],
                'status' => $data['status'] ?? 0,
                'language' => $data['language'] ?? 'en',
                'canCreateOrder' => $data['canCreateOrder'],
                'showBuilder' => $data['showBuilder'],
            ]);
            return 'ok';
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(array $data, int $id): int|string
    {
        try  {
            $user = $this->model::findOrfail($id);
            $user->fill([
                'position' => $data['position'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'language' => $data['language'],
                'status' => $data['status'],
                'canCreateOrder' => $data['canCreateOrder'],
                'showBuilder' => $data['showBuilder'],
            ]);
            $user->save();
            return $id;
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(int $id): int
    {
        User::destroy($id);
        return $id;
    }

}
