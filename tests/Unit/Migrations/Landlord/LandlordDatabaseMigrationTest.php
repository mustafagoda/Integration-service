<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations\Landlord;

use Tests\TestCase;

class LandlordDatabaseMigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function testLandlordUserTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            'mobile_no',
            'role_id'
        ];
        $this->testMigrationsTable('users', $expectedColumns);
    }

    public function testLandlordPasswordResetTokensTableHasExpectedColumns()
    {
        $expectedColumns = [
            'email',
            'token',
            'created_at',
        ];
        $this->testMigrationsTable('password_reset_tokens', $expectedColumns);
    }

    public function testLandlordTenantTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by',
            'status',
            'name',
            'slug',
            'domain',
            'database',
        ];
        $this->testMigrationsTable('landlord_tenants', $expectedColumns);
    }


    public function testTenantCurrenciesTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'status',
            'slug',
            'name',
            'is_default',
            'icon',
        ];
        $this->testMigrationsTable('currencies', $expectedColumns);
    }

    public function testTenantLanguagesTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'status',
            'slug',
            'name',
            'direction',
            'is_default',
            'icon',
        ];
        $this->testMigrationsTable('languages', $expectedColumns);
    }

    public function testTenantRoleTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'name',
            'slug',
        ];
        $this->testMigrationsTable('roles', $expectedColumns);
    }

    public function testTenantPermissionsTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'permission_group',
            'name',
            'slug',
        ];
        $this->testMigrationsTable('permissions', $expectedColumns);
    }

    public function testTenantPermissionRoleTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'permission_id',
            'role_id',
        ];
        $this->testMigrationsTable('permission_role', $expectedColumns);
    }
}
