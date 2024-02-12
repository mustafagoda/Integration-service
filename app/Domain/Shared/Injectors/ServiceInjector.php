<?php

namespace App\Domain\Shared\Injectors;

use App\Domain\Shared\Services\Classes\TenantManager;
use App\Domain\Shared\Services\Interfaces\ITenantManager;
use App\Providers\AppServiceProvider;

class ServiceInjector extends AppServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(ITenantManager::class, TenantManager::class);
    }
}
