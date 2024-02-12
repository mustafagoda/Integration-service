<?php

namespace App\Domain\Tenant\ReportBug\Injectors;

use App\Domain\Tenant\ReportBug\Services\Classes\CreateIssueService;
use App\Domain\Tenant\ReportBug\Services\Classes\ListProjectService;
use App\Domain\Tenant\ReportBug\Services\Interfaces\ICreateIssueService;
use App\Domain\Tenant\ReportBug\Services\Interfaces\IListProjectService;
use App\Providers\AppServiceProvider;

class ReportBugServiceInjector extends AppServiceProvider
{

    public function boot(): void
    {
        $this->app->singleton(IListProjectService::class,ListProjectService::class);
        $this->app->singleton(ICreateIssueService::class,CreateIssueService::class);
    }
}
