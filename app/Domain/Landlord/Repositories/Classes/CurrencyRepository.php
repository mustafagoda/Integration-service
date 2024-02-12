<?php

namespace App\Domain\Landlord\Repositories\Classes;

use App\Domain\Landlord\Repositories\Interfaces\ICurrencyRepository;
use App\Domain\Shared\Repositories\Classes\AbstractRepository;
use Illuminate\Support\Facades\Cache;

class CurrencyRepository extends AbstractRepository implements ICurrencyRepository
{
    /**
     * @return mixed
     */
    public function findActiveCurrenciesForTenant(): mixed
    {
        return Cache::store('file')->rememberForever(get_tenant_cache_key() . 'currencies', function () {
            return $this->listAllBy()->keyBy('slug');
        });
    }
}
