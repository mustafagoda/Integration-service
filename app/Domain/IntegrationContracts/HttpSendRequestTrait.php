<?php

declare(strict_types=1);

namespace App\Domain\IntegrationContracts;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use Throwable;

trait HttpSendRequestTrait
{
    /**
     * Send the HTTP request based on the request type.
     *
     * @param array $data
     * @return Response|PromiseInterface
     * @throws Throwable
     */
    protected function sendRequest(array $data): Response|PromiseInterface
    {
        $requestBody = $this->buildRequestBody($data);
        $requestType = $this->getRequestType();
        $headers = $this->supplierObject->buildHeader();
        $request = Http::withHeaders($headers);
        if ($requestType === 'form') {
            return $request->asForm()->send(
                $this->getRequestMethod(),
                $this->getRequestEndpoint(),
                [
                    'form_params' => $requestBody,
                ]
            );
        } elseif ($requestType === 'json') {
            if (is_array($requestBody)) {
                $requestBody = json_encode($requestBody);
            }

            return $request->send(
                $this->getRequestMethod(),
                $this->getRequestEndpoint(),
                [
                    'body' => $requestBody,
                ]
            );
        }

        throw new InvalidArgumentException(trans('Unsupported request type'));
    }
}
