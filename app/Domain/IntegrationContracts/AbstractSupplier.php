<?php

namespace App\Domain\IntegrationContracts;

abstract class AbstractSupplier
{
    /**
     * @return string
     */
    abstract public function getBaseUrl(): string;

    /**
     * @return array
     */
    abstract public function buildHeader(): array;
}
