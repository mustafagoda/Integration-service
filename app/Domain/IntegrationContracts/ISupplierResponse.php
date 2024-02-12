<?php

declare(strict_types=1);

namespace App\Domain\IntegrationContracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;

interface ISupplierResponse
{
    /**
     * @param Response|array|Model $response
     * @return array|Model|string
     */
    public function parse(Response|array|Model $response): array|Model|string;
}
