<?php

declare(strict_types=1);

use App\Domain\IntegrationContracts\SupplierEnvironmentEnum;
use App\Domain\Tenant\ReportBug\Enum\ReportBugSupplierEnum;

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'report-bug' => [
        'suppliers' => [
            ReportBugSupplierEnum::JIRA->value => [
                SupplierEnvironmentEnum::TEST->value => [
                    'base_url' => env('TEST_URL_JIRA', 'https://tenant.atlassian.net/'),
                    'api_token' => 'ATATT3xFfGF07-NXrOWrM0vOHsHnrgDBLioHr54IJ0RcNRWmt4PqOoxW1S-AguChtTbykM7oAYeqwNq4G_HZXNsV4Wn86G-xFyAkDo2C8UVm0Dp_ihNlazqo4rCBm-i9yRds31SRVsGNwGFp-r_jdv9Xuzhvc8MraJyx2tR5L9K3ZMAF2JGA7Qs=3FFC2417',
                    'username' => 'mostafagoda199@gmail.com',
                ],
                SupplierEnvironmentEnum::LIVE->value => [
                    'base_url' => env('URL_JIRA', 'https://tenant.atlassian.net/'),
                    'api_token' => 'ATATT3xFfGF07-NXrOWrM0vOHsHnrgDBLioHr54IJ0RcNRWmt4PqOoxW1S-AguChtTbykM7oAYeqwNq4G_HZXNsV4Wn86G-xFyAkDo2C8UVm0Dp_ihNlazqo4rCBm-i9yRds31SRVsGNwGFp-r_jdv9Xuzhvc8MraJyx2tR5L9K3ZMAF2JGA7Qs=3FFC2417',
                    'username' => 'mostafagoda199@gmail.com',
                ],
            ],
        ],
    ],
];
