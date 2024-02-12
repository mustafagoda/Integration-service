<?php

namespace App\Domain\Landlord\Injectors;

use App\Domain\Landlord\Repositories\Classes\CurrencyRepository;
use App\Domain\Landlord\Repositories\Classes\LanguageRepository;
use App\Domain\Landlord\Repositories\Interfaces\ICurrencyRepository;
use App\Domain\Landlord\Repositories\Interfaces\ILanguageRepository;
use App\Models\Currency;
use App\Models\Language;
use App\Providers\AppServiceProvider;

class LandlordRepositoryInjector extends AppServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        $this->app->singleton(ICurrencyRepository::class, function (){
            return new CurrencyRepository(new Currency());
        });

        $this->app->singleton(ILanguageRepository::class, function (){
            return new LanguageRepository(new Language());
        });
    }
}
