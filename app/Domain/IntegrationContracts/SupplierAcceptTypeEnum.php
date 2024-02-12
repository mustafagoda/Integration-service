<?php

namespace App\Domain\IntegrationContracts;

enum SupplierAcceptTypeEnum: string
{
    case REST = 'application/json';

    case SOAP = 'application/xml';
}
