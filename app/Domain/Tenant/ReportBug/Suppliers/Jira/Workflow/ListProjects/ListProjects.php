<?php

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\ListProjects;

use App\Domain\IntegrationContracts\ISupplierIntegration;
use App\Domain\IntegrationContracts\ISupplierRequest;
use App\Domain\IntegrationContracts\ISupplierResponse;

class ListProjects implements ISupplierIntegration
{
    public function request(): ISupplierRequest
    {
       return new ListProjectsRequest();
    }

    public function response(): ISupplierResponse
    {
        return new ListProjectsResponse();
    }
}
