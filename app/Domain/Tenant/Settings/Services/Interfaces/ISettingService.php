<?php

namespace App\Domain\Tenant\Settings\Services\Interfaces;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Application;

interface ISettingService
{
    /**
     * @return Collection|array
     */
    public function listAllSettings(): Collection|array;

    /**
     * @param string $settingSlug
     * @return Model|Builder
     */
    public function showSetting(string $settingSlug): Model|Builder;

    /**
     * @param string $settingSlug
     * @param array $data
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function updateSetting(string $settingSlug, array $data): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null;

}
