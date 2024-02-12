<?php

declare(strict_types=1);

namespace App\Domain\IntegrationContracts;

interface ISupplierIntegration
{
    /**
     * @return ISupplierRequest
     */
    public function request(): ISupplierRequest;

    /**
     * @return ISupplierResponse
     */
    public function response(): ISupplierResponse;
}
