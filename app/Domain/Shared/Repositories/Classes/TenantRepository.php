<?php

declare(strict_types=1);

namespace App\Domain\Shared\Repositories\Classes;

use App\Domain\Shared\Repositories\Interfaces\ITenantRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TenantRepository extends AbstractRepository implements ITenantRepository
{
    /**
     * @param string|null $identifier
     * @return ?Model
     */
    public function getTenantByIdentifier(string|null $identifier): ?Model
    {
        return Cache::store('file')->rememberForever(get_tenant_cache_key() . get_request_domain() . ':tenant', function () use ($identifier) {
            return $this->first(conditions: [
                'domain' => $identifier,
            ], orConditions: [
                'slug' => $identifier,
            ]);
        });
    }
}
