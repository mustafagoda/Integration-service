<?php

namespace App\Domain\Landlord\Repositories\Interfaces;

interface ILanguageRepository
{
    public function findActiveLanguagesForTenant(): mixed;

}
