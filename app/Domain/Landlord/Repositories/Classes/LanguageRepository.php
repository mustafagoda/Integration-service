<?php

namespace App\Domain\Landlord\Repositories\Classes;

use App\Domain\Landlord\Repositories\Interfaces\ILanguageRepository;
use App\Domain\Shared\Repositories\Classes\AbstractRepository;
use Illuminate\Support\Facades\Cache;

class LanguageRepository extends AbstractRepository implements ILanguageRepository
{
    /**
     * @return mixed
     */
    public function findActiveLanguagesForTenant(): mixed
    {
        return Cache::store('file')->rememberForever(get_tenant_cache_key() . 'languages', function () {
            return $this->listAllBy()->keyBy('slug');
        });
    }
}
