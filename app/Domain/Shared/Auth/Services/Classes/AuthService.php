<?php

namespace App\Domain\Shared\Auth\Services\Classes;

use App\Domain\Shared\Auth\Services\Interfaces\IAuthService;
use App\Domain\Shared\Repositories\Interfaces\IUserRepository;
use App\Exceptions\Custom\ApiCustomException;
use App\Models\Tenant\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuthService implements IAuthService
{
    public function __construct(private readonly IUserRepository $userRepository)
    {
    }

    public function registerUser(array $requestData): User|\App\Models\User
    {
       $user = $this->userRepository->create($requestData);
       return $this->appendTokenToUser($user);
    }

    /**
     * @throws Throwable
     */
    public function loginUser(array $requestData): Model|Builder
    {
        throw_if(! Auth::attempt($requestData), new ApiCustomException(message: trans('messages.invalid_user_credentials')));
        $user = $this->userRepository->firstOrFail([
            'email' => $requestData['email'],
        ]);
        return $this->appendTokenToUser($user);
    }

    private function appendTokenToUser(User|Builder|Model $user): User|Builder|Model
    {
        $permissions = [];
        if(!empty($user->role)){
            $permissions = $user->role->permissions ? Arr::pluck($user->role->permissions, 'slug') : [];
        }

        $createdToken = $user->createToken(DB::getDefaultConnection(), $permissions);
        $user->token = $createdToken->plainTextToken;
        $user->abilities = $createdToken->accessToken->abilities;
        return $user;
    }
}
