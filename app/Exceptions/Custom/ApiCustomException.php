<?php

declare(strict_types=1);

namespace App\Exceptions\Custom;

use App\Domain\Shared\Responder\Interfaces\IApiHttpResponder;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiCustomException extends Exception
{
    /**
     * @var int
     */
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    public function render(): JsonResponse
    {
        return resolve(IApiHttpResponder::class)
            ->response(message: $this->message, status: $this->code);
    }
}
