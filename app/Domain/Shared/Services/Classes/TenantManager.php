<?php

declare(strict_types=1);

namespace App\Domain\Shared\Services\Classes;

use App\Domain\Shared\Repositories\Interfaces\ITenantRepository;
use App\Domain\Shared\Services\Interfaces\ITenantManager;
use App\Models\LandlordTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class TenantManager implements ITenantManager
{
    /**
     * @var LandlordTenant|Model|null
     */
    private LandlordTenant|null|Model $tenant = null;

    public function __construct(
        private readonly ITenantRepository $tenantRepository
    ) {
    }

    /**
     * @param LandlordTenant|Model|null $tenant
     * @param String|null $connection
     * @return $this
     */
    public function setTenant(LandlordTenant|Model|null $tenant, string $connection = null): static
    {
        $this->tenant = $tenant;
        $connection = $connection ?? get_current_connection();

        config([
            'database.connections.' . $connection . '.database' => $tenant->database,
            'database.default' => $connection,
        ]);

        return $this;
    }

    /**
     * @return LandlordTenant|Model|null
     */
    public function getTenant(): Model|LandlordTenant|null
    {
        return $this->tenant;
    }

    /**
     * @param $identifier
     * @return Model|bool
     */
    public function loadTenant($identifier): Model|bool
    {
        $tenantByDomain = $this->tenantRepository->getTenantByIdentifier($identifier);

        if (isset($tenantByDomain)) {
            $this->setTenant($tenantByDomain, 'tenant');
            Session::put('tenant_id_' . crc32($identifier), $tenantByDomain->id);
            return $tenantByDomain;
        }
        return false;
    }
}
