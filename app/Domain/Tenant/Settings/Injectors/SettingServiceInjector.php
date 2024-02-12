<?php

namespace App\Domain\Tenant\Settings\Injectors;

use App\Domain\Tenant\Settings\Services\Classes\SettingService;
use App\Domain\Tenant\Settings\Services\Interfaces\ISettingService;
use App\Providers\AppServiceProvider;

class SettingServiceInjector extends AppServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(ISettingService::class, SettingService::class);
    }
}
