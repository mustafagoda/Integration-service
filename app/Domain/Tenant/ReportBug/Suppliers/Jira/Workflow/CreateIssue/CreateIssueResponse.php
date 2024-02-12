<?php

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\CreateIssue;

use App\Domain\IntegrationContracts\ISupplierResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;

class CreateIssueResponse implements ISupplierResponse
{
    public function parse(Model|array|Response $response): array|Model
    {
        return $response->json();
    }
}
