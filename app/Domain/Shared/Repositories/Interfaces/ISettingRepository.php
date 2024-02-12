<?php

declare(strict_types=1);

namespace App\Domain\Shared\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ISettingRepository
{
    public function getSetting(): Collection|array;
}
