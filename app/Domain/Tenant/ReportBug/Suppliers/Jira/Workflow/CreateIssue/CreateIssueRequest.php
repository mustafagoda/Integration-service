<?php

namespace App\Domain\Tenant\ReportBug\Suppliers\Jira\Workflow\CreateIssue;

use App\Domain\IntegrationContracts\ISupplierRequest;
use Illuminate\Database\Eloquent\Model;

class CreateIssueRequest implements ISupplierRequest
{

    /**
     * @var string
     */
    public string $method = 'post';

    /**
     * @var string
     */
    public string $requestType = 'json';

    /**
     * @var string
     */
    private string $endpoint = 'rest/api/2/issue';

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
        return json_encode([
            'fields' => [
                'description' => optional($criteria)['description'],
                'issuetype' => ['id' => 10009],
                'labels' => ['bugfix'],
                'project' => ['id' => optional($criteria)['projectId']],
                'summary' => optional($criteria)['title']
            ],
        ]);
    }
}
