<?php

namespace App\Domain\Landlord\Repositories\Interfaces;

interface ICurrencyRepository
{
    public function findActiveCurrenciesForTenant(): mixed;
}
