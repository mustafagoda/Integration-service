<?php

namespace App\Domain\Tenant\ReportBug\Services\Interfaces;

interface ICreateIssueService
{
    public function createIssue(array $data): array;
}
