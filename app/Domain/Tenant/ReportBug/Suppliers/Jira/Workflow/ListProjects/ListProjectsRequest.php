<?php

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\ListProjects;

use App\Domain\IntegrationContracts\ISupplierRequest;
use Illuminate\Database\Eloquent\Model;

class ListProjectsRequest implements ISupplierRequest
{

    /**
     * @var string
     */
    public string $method = 'get';

    /**
     * @var string
     */
    public string $requestType = 'json';

    /**
     * @var string
     */
    private string $endpoint = 'rest/api/2/project';

    /**
     * Set the endpoint.
     *
     * @param ?string $appendEndpoint
     */
    public function setEndpoint(?string $appendEndpoint = ''): void
    {
        $this->endpoint .= $appendEndpoint;
    }

    /**
     * Get the current endpoint.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function buildBody(array $criteria = []): array|Model|string
    {
        return json_encode([]);
    }

}
