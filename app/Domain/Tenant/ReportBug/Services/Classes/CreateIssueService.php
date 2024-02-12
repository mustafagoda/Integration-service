<?php

declare(strict_types=1);

namespace App\Domain\Tenant\ReportBug\Services\Classes;

use App\Domain\IntegrationContracts\AbstractSupplierService;
use App\Domain\IntegrationContracts\HttpSendRequestTrait;
use App\Domain\Tenant\ReportBug\Services\Interfaces\ICreateIssueService;
use App\Domain\Tenant\ReportBug\Suppliers\Jira\Jira;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;
use Throwable;

class CreateIssueService extends AbstractSupplierService implements ICreateIssueService
{
    use HttpSendRequestTrait;

    /**
     * @throws Exception
     */
    public function createIssue(array $data): array
    {
        $this->setSupplierObject([
            'supplier' => Jira::class,
        ]);
        try {
            $response = $this->sendRequest($data);
            return $this->handleResponse($response);
        } catch (Throwable $throwable) {
            throw new Exception($throwable->getMessage());
        }
    }

    /**
     * @return string
     */
    private function getRequestMethod(): string
    {
        return $this->supplierObject
            ->createIssue()->request()->method;
    }

    /**
     * @return string
     * @throws Throwable
     */
    public function getRequestEndpoint(): string
    {
        $supplierRequest = $this->supplierObject
            ->createIssue()
            ->request();
        $supplierRequest->setEndpoint();
        return $this->supplierObject->getBaseUrl() .
            $supplierRequest->getEndpoint();
    }

    /**
     * @param array $requestCriteria
     * @return array|string
     */
    protected function buildRequestBody(array $requestCriteria): array|string
    {
        return $this->supplierObject
            ->createIssue()->request()
            ->buildBody($requestCriteria);
    }

    /**
     * @param Response|array|Model $response
     * @return array
     */
    protected function handleResponse(Response|array|Model $response): array
    {
        return $this->supplierObject
            ->createIssue()->response()
            ->parse($response);
    }

    private function getRequestType(): string
    {
        return $this->supplierObject
            ->createIssue()
            ->request()->requestType;
    }
}
