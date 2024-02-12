<?php

declare(strict_types=1);

namespace Tests\Unit\Commands;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MigrateTenantDBTest extends TestCase
{
    private string $databaseName = 'tenant_db_1';

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('create:db', [
            'dbname' => $this->databaseName,
        ]);
    }

    public function testCommandCanMigrateAllTenantsDatabases()
    {
        $this->artisan('tenants:migrate')->assertExitCode(0);
        $this->assertTrue(Schema::hasTable('users'));
    }

    public function testCommandCanMigrateForSpecificTenantDatabase()
    {
        $this->artisan('tenants:migrate ' . $this->databaseName)->assertExitCode(0);
        $this->assertTrue(Schema::hasTable('users'));
    }

    public function testCommandCanRefreshTenantDatabase()
    {
        $this->artisan('tenants:migrate', [
            'tenantDB' => $this->databaseName,
            '--refresh' => true,
        ])->assertExitCode(0);

        config([
            'database.default' => 'tenant',
            'database.tenant.database' => $this->databaseName,
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'tenant.admin@travware.com',
        ]);
        reset_landlord_connection();
    }

    public function testCommandCanSeedTenantDatabase()
    {
        $this->artisan('tenants:migrate ' . $this->databaseName . ' --seed')->assertExitCode(0);

        config([
            'database.default' => 'tenant',
            'database.tenant.database' => $this->databaseName,
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'tenant.admin@travware.com',
        ]);

        reset_landlord_connection();
    }

}
