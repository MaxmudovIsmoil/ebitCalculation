<?php

namespace App\Services;

use App\Enums\TokenAbility;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Http\Resources\UserLoginResource;
use App\Ldap\Ldap;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{

    public function __construct(
        public User $model,
    ) {}


    public function login(array $data): array
    {
        $user = $this->model->whereUsername($data['username'])->first();

        if ($user === null) {
            throw new NotFoundException(message:'User not found', code:404);
        }

        if ($user->rule !== "1") {
            // use ldap production
            $this->authenticateUserWithLdap($user, $data['password']);

            // not use ldap for developer test
//             $this->authenticateAdminUser($user, $data['password']);
        }
        else {
            $this->authenticateAdminUser($user, $data['password']);
        }

        return [
            'accessToken' => $this->token($user),
            'user' => new UserLoginResource($user)
        ];
    }

    protected function authenticateUserWithLdap(object $user, string $password): void
    {
        $ldap = new Ldap();
        $ldapResponse = $ldap->handle($user->username, $password);

        if ($ldapResponse['status'] === true) {
            $passwordData = ['password' => Hash::make($password)];
            $this->model->updateOrCreate(['id' => $user->id], $passwordData);
        } else {
            throw new UnauthorizedException(message: 'Unauthorized', code: 401);
        }
    }

    protected function authenticateAdminUser(object $user, string $password): void
    {
        if (!Hash::check($password, $user->getAuthPassword())) {
            throw new UnauthorizedException(message: 'Unauthorized', code: 401);
        }
    }



    public function token(object $user): string
    {
        $expiresAt = Carbon::now()->addMinutes(config('sanctum.expiration'));
        $accessToken = $user->createToken('access-token', [TokenAbility::ACCESS_TOKEN->value], $expiresAt);

        return $accessToken->plainTextToken;
    }


    public function profile()
    {
        return ['user' => new UserLoginResource(auth()->user())];
    }

    public function profileUpdate(array $data)
    {
        $user = User::findOrFail(Auth::id());
        if (isset($data['name'])) {
            $user->fill(['name' => $data['name']]);
        }
        if (isset($data['language'])) {
            $user->fill(['language' => $data['language']]);
        }
        $user->fill(['update' => now()]);
        $user->save();

        return $data;
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        Auth::guard('web')->logout();
    }

}
