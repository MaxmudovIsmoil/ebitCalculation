<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Http\Resources\UserLoginResource;
use App\Ldap\Ldap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{

    public function __construct(
        public User $model,
    ) {}

    public function login(array $data): void
    {
        $user = $this->model
            ->where('username', $data['username'])
            ->where('status', 1)
            ->first();

        if ($user === null) {
            throw new NotFoundException(message:'<i class="fa-solid fa-magnifying-glass-minus"></i> User not found', code:404);
        }

        if ($user->ldap == 1) {
            // use ldap
            $this->authenticateUserWithLdap($user, $data['password']);

            // not use ldap for developer test branch
//            $this->authenticateAdminUser($user, $data['password']);
        }
        else {
            $this->authenticateAdminUser($user, $data['password']);
        }

        Auth::login($user);
    }


    public function logout()
    {
        Auth::logout();
    }


    protected function authenticateUserWithLdap(object $user, string $password): void
    {
        $ldap = new Ldap();
        $ldapResponse = $ldap->handle($user->login, $password);

        if ($ldapResponse['status'] === true) {
            $passwordData = ['password' => Hash::make($password)];
            $this->model->updateOrCreate(['id' => $user->id], $passwordData);
        } else {
            throw new UnauthorizedException(message: '<i class="fa-solid fa-triangle-exclamation"></i> The password is incorrect.', code: 401);
        }
    }

    protected function authenticateAdminUser(object $user, string $password): void
    {
        if (!Hash::check($password, $user->getAuthPassword())) {
            throw new UnauthorizedException(message: '<i class="fa-solid fa-triangle-exclamation"></i> The password is incorrect.', code: 401);
        }
    }

    public function profile(array $data)
    {
        $userId = Auth::id();
        $user = User::findOrfail($userId);
        if (isset($data['password'])) {
            $user->fill(['password' => Hash::make($data['password'])]);
        }
        $user->fill([
            'name' => $data['name'],
            'username' => $data['username']
        ]);
        $user->save();
        return $userId;
    }


}
