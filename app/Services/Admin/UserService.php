<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(
        public User $model,
    ) {}

    public function getUsers()
    {
        return $this->model->where('role', '0')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getOne(int $userId)
    {
        return $this->model->findOrFail($userId);
    }

    public function store(array $data): array
    {
        $username = explode('@', $data['email']);
        $this->model->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'username' => strtolower($username[0]),
            'ldap' => $data['ldap'],
            'status' => $data['status'],
            'canCreateOrder' => $data['canCreateOrder'],
        ]);

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $user = $this->model->findOrFail($id);

        if (isset($data['name']))
            $user->fill(['name' => $data['name']]);

        if (isset($data['phone']))
            $user->fill(['phone' => $data['phone']]);

        if (isset($data['email'])) {
            $user->fill(['email' => $data['email']]);
            $username = explode('@', $data['email']);
            $user->fill(['username' => strtolower($username[0])]);
        }

        if (isset($data['password']))
            $user->fill(['password' => Hash::make($data['password'])]);

        if (isset($data['status']))
            $user->fill(['status' => $data['status']]);

        if (isset($data['canCreateOrder']))
            $user->fill(['canCreateOrder' => $data['canCreateOrder']]);

        $user->save();

        return $user->toArray();
    }


    public function destroy(int $id)
    {
        $this->model->destroy($id);
        return $id;
    }
}
