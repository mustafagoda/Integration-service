<?php

declare(strict_types=1);

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira;

use App\Domain\IntegrationContracts\AbstractSupplier;
use App\Domain\IntegrationContracts\SupplierEnvironmentEnum;
use App\Domain\Tenant\ReportBug\Enum\ReportBugSupplierEnum;
use App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\CreateIssue\CreateIssue;
use App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\ListProjects\ListProjects;

class Jira extends AbstractSupplier
{
    public function getBaseUrl(): string
    {
        return config('services.report-bug.suppliers.' . ReportBugSupplierEnum::JIRA->value . '.' . SupplierEnvironmentEnum::TEST->value . '.base_url');

    }

    public function buildHeader(): array
    {
       $username = config('services.report-bug.suppliers.' . ReportBugSupplierEnum::JIRA->value . '.' . SupplierEnvironmentEnum::TEST->value . '.username');
       $apiToken = config('services.report-bug.suppliers.' . ReportBugSupplierEnum::JIRA->value . '.' . SupplierEnvironmentEnum::TEST->value . '.api_token');
       $authorization = 'Basic '. base64_encode("{$username}:{$apiToken}");
        return [
            'Accept' => 'application/json',
            'Authorization' => $authorization,
            'content-type' => 'application/json'
        ];
    }

    public function listProjects(): ListProjects
    {
        return new ListProjects();
    }

    public function createIssue(): CreateIssue
    {
        return new CreateIssue();
    }
}
