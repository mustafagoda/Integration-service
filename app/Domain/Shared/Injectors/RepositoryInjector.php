<?php

declare(strict_types=1);

namespace App\Domain\Shared\Injectors;

use App\Domain\Shared\Repositories\Classes\SettingRepository;
use App\Domain\Shared\Repositories\Classes\TenantRepository;
use App\Domain\Shared\Repositories\Classes\UserRepository;
use App\Domain\Shared\Repositories\Interfaces\ISettingRepository;
use App\Domain\Shared\Repositories\Interfaces\ITenantRepository;
use App\Domain\Shared\Repositories\Interfaces\IUserRepository;
use App\Models\LandlordTenant;
use App\Models\Setting;
use App\Models\User;
use App\Providers\AppServiceProvider;

class RepositoryInjector extends AppServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(ITenantRepository::class, function () {
            return new TenantRepository(new LandlordTenant());
        });

        $this->app->singleton(IUserRepository::class, function () {
            return new UserRepository(new User());
        });

        $this->app->singleton(ISettingRepository::class, function () {
            return new SettingRepository(new Setting());
        });
    }
}
