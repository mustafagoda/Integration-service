<?php

namespace App\Domain\Tenant\ReportBug\Services\Interfaces;

interface IListProjectService
{
    public function listProjects(array $data): array;
}
