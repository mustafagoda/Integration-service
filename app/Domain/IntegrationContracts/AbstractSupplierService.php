<?php

declare(strict_types=1);

namespace App\Domain\IntegrationContracts;

use App\Domain\Tenant\ReportBug\Suppliers\Jira\Jira;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;

abstract class AbstractSupplierService
{
    protected AbstractSupplier|Jira $supplierObject;

    public function setSupplierObject(array $supplierData = []): void
    {
        $this->supplierObject = new $supplierData['supplier']();
    }

    /**
     * @return AbstractSupplier
     */
    public function getSupplierObject(): AbstractSupplier
    {
        return $this->supplierObject;
    }

    /**
     * @param array $requestCriteria
     * @return array|Model|string
     */
    abstract protected function buildRequestBody(array $requestCriteria): array|Model|string;

    /**
     * @param Response|array|Model $response
     * @return array|Model|string
     */
    abstract protected function handleResponse(Response|array|Model $response): array|Model|string;
}
