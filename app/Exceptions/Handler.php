<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Domain\Tenant\ReportBug\Services\Interfaces\ICreateIssueService;
use App\Exceptions\Custom\ApiCustomException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof ApiCustomException && in_array($e->getCode(), [401, 403, 422], true) || $e instanceof ValidationException) {
            return parent::render($request, $e);
        }

        if (app()->environment() === 'production') {
            resolve(ICreateIssueService::class)->createIssue(
                [
                    'projectId' => env('JIRA_PROJECT_ID', 10002),
                    'title' => $e->getMessage(),
                    'description' =>
                        $e->getMessage() .
                        ' File: ' . $e->getFile() .
                        ' Line: ' . $e->getLine(),
                ]
            );
        }
        return parent::render($request, $e);
    }
}
