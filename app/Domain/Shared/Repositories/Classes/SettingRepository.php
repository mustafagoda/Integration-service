<?php

declare(strict_types=1);

namespace App\Domain\Shared\Repositories\Classes;

use App\Domain\Shared\Repositories\Interfaces\ISettingRepository;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository extends AbstractRepository implements ISettingRepository
{
    public function getSetting(): Collection|array
    {
        return $this->listAllBy();
    }
}
