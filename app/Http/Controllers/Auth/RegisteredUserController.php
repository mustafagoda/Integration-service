<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domain\Shared\Auth\DTO\UserDTO;
use App\Domain\Shared\Auth\Services\Interfaces\IAuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function __construct(
        private readonly IAuthService $authService
    ) {
    }

    /**
     * Display the registration view.
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $registerRequest = array_filter((array) UserDTO::fromRequest($request->validated()));
        $user = $this->authService->registerUser($registerRequest);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', $user->id));
    }
}
