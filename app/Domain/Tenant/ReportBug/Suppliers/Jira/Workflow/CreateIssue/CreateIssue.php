<?php

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\CreateIssue;

use App\Domain\IntegrationContracts\ISupplierIntegration;
use App\Domain\IntegrationContracts\ISupplierRequest;
use App\Domain\IntegrationContracts\ISupplierResponse;

class CreateIssue implements ISupplierIntegration
{
    public function request(): ISupplierRequest
    {
       return new CreateIssueRequest();
    }

    public function response(): ISupplierResponse
    {
        return new CreateIssueResponse();
    }
}
