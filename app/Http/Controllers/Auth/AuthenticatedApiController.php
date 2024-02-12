<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Shared\Auth\DTO\UserDTO;
use App\Domain\Shared\Auth\Services\Interfaces\IAuthService;
use App\Domain\Shared\Responder\Interfaces\IApiHttpResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthenticatedApiController extends Controller
{
    public function __construct(private readonly IAuthService $authService, private readonly IApiHttpResponder $apiHttpResponder)
    {
    }

    public function register(RegisterRequest $request): UserResource
    {
        $registerRequest = array_filter((array) UserDTO::fromRequest($request->validated()));

        $user = $this->authService->registerUser($registerRequest);

        event(new Registered($user));

        Auth::login($user);

        return new UserResource($user);
    }

    /**
     * @throws Throwable
     */
    public function login(LoginRequest $request): UserResource
    {
        $user = $this->authService->loginUser($request->validated());
        return new UserResource($user);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->apiHttpResponder->response(message: trans('messages.logout'));
    }
}
