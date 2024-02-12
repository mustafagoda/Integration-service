<?php

namespace App\Domain\Tenant\Settings\Injectors;

use App\Domain\Tenant\Settings\Repositories\Classes\TenantSettingRepository;
use App\Domain\Tenant\Settings\Repositories\Interfaces\ITenantSettingRepository;
use App\Models\Tenant\DynamicSetting;
use App\Providers\AppServiceProvider;

class SettingRepositoryInjector extends AppServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(ITenantSettingRepository::class,function (){
            return new TenantSettingRepository(new DynamicSetting());
        });
    }
}
