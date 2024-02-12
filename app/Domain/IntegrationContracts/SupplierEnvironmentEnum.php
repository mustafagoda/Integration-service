<?php

namespace App\Domain\IntegrationContracts;

enum SupplierEnvironmentEnum: string
{
    case TEST = 'test';
    case LIVE = 'live';
}
