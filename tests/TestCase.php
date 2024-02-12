<?php

declare(strict_types=1);

namespace Tests;

use App\Models\LandlordTenant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Mockery;
use PDO;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected static bool $migrated = false;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        Cache::store('file')->flush();
        Queue::fake();
        DB::connection()->disableQueryLog();
        $this->artisan('optimize:clear');
        $this->artisan('config:clear');

        if (! self::$migrated) {
            $this->createTenantDB(env('DB_TENANT_DATABASE_TEST', 'test_integration_tenant_1'));
            $this->artisan('migrate:fresh', [
                '--seed' => true,
            ]);
            $this->migrateFreshTenant();
            self::$migrated = true;
        }
    }

    public function switchToTenantDBTest(): void
    {
        config([
            'database.connections.tenant.database' => get_tenant_db_prefix_by_env() . config('multitenancy.tenant_id'),
            'database.default' => 'tenant',
        ]);
    }

    public function getTestTenantDetails()
    {
        return LandlordTenant::first();
    }

    protected function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        Cache::flush();
        parent::tearDown();
        Mockery::close();
        gc_collect_cycles();
    }

    /**
     * @param null $databaseName
     * @return void
     */
    protected function createTenantDB($databaseName = null): void
    {
        $dbName = null !== $databaseName ? $databaseName : get_tenant_db_prefix_by_env() . config('multitenancy.tenant_id');
        $this->artisan('create:db', [
            'dbname' => $dbName,
        ]);
    }

    /**
     * @param null $databaseName
     * @return void
     */
    protected function migrateFreshTenant($databaseName = null): void
    {
        $dbName = null !== $databaseName ? $databaseName : get_tenant_db_prefix_by_env() . config('multitenancy.tenant_id');
        $this->artisan('tenants:migrate', [
            'tenantDB' => $dbName,
            '--fresh' => true,
            '--seed' => true,
        ]);
    }

    protected function testMigrationsTable(string $tableName, array $expectedColumns, string|null $connection = 'mysql'): void
    {
        $tableExists = Schema::hasTable($tableName);
        $actualColumns = Schema::getColumnListing($tableName);
        $this->assertTrue($tableExists, 'The ' . $tableName . ' table does not exist in the database.');
        $this->assertEquals($expectedColumns, $actualColumns, 'The ' . $tableName . ' table does not have the expected columns.');
    }

    protected function removeDirectory($path): void
    {
        if (file_exists($path)) {
            exec("rm -rf $path");
        }
    }
}
