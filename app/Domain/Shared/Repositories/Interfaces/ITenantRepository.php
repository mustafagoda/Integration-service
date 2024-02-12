<?php

namespace App\Domain\Shared\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ITenantRepository
{
    public function getTenantByIdentifier(string|null $identifier): ?Model;
}
