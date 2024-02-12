<?php

namespace App\Domain\Shared\Auth\Injectors;

use App\Domain\Shared\Auth\Services\Classes\AuthService;
use App\Domain\Shared\Auth\Services\Interfaces\IAuthService;
use App\Providers\AppServiceProvider;

class AuthServiceInjector extends AppServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(IAuthService::class,AuthService::class);
    }
}
