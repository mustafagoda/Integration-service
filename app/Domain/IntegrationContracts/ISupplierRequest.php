<?php

namespace App\Domain\IntegrationContracts;

use Illuminate\Database\Eloquent\Model;

interface ISupplierRequest
{
    /**
     * @param array $criteria
     * @return array|Model|string
     */
    public function buildBody(array $criteria = []): array|Model|string;
}
