<?php

declare(strict_types=1);

use Database\Seeders\tenant\DatabaseSeeder;

return [
    'prefix' => env('DB_PREFIX', 'integration_tenant_'),

    'prefix_test' => env('DB_PREFIX', 'test_integration_tenant_'),

    'landlord_connection' => env('DB_CONNECTION', 'pgsql'),

    'tenant_connection' => env('TENANT_CONNECTION', 'tenant'),

    'tenant_id' => env('TENANT_ID', '1'),

    /*
     |-----------------------------------------------------------------------
     | Tenant Database Migrations
     |-----------------------------------------------------------------------
     */
    'migrations' => [
        'path' => '/database/migrations/tenant/',
    ],

    'seeder' => [
        'class' => DatabaseSeeder::class,
    ],
];
