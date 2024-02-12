<?php

namespace App\Domain\Shared\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ITenantManager
{
    public function loadTenant($identifier): Model|bool;
}
