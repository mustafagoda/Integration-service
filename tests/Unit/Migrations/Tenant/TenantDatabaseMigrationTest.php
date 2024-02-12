<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations\Tenant;

use Tests\TestCase;

class TenantDatabaseMigrationTest extends TestCase
{
    private string $connection = 'tenant';

    protected function setUp(): void
    {
        parent::setUp();
        $databaseName = get_tenant_db_prefix_by_env() . config('multitenancy.tenant_id');

        config([
            'database.connections.' . $this->connection . '.database' => $databaseName,
            'database.default' => $this->connection,
        ]);
    }

    public function testTenantUserTableHasExpectedColumns()
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
        $this->testMigrationsTable('users', $expectedColumns, $this->connection);
    }

    public function testTenantPasswordResetTokensTableHasExpectedColumns()
    {
        $expectedColumns = [
            'email',
            'token',
            'created_at',
        ];
        $this->testMigrationsTable('password_reset_tokens', $expectedColumns, $this->connection);
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
        $this->testMigrationsTable('currencies', $expectedColumns, $this->connection);
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
        $this->testMigrationsTable('languages', $expectedColumns, $this->connection);
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
        $this->testMigrationsTable('roles', $expectedColumns, $this->connection);
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
        $this->testMigrationsTable('permissions', $expectedColumns, $this->connection);
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
        $this->testMigrationsTable('permission_role', $expectedColumns, $this->connection);
    }

    public function testTenantDynamicSettingsTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'status',
            'slug',
            'name',
            'description',
            'icon',
        ];
        $this->testMigrationsTable('dynamic_settings', $expectedColumns, $this->connection);
    }

    public function testTenantAttributeCategoriesTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'dynamic_setting_id',
            'status',
            'slug',
            'name',
            'description',
            'icon',
        ];
        $this->testMigrationsTable('attribute_categories', $expectedColumns, $this->connection);
    }

    public function testTenantAttributesTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'status',
            'slug',
            'name',
            'tooltip',
            'placeholder',
            'validation',
            'type',
            'icon',
        ];
        $this->testMigrationsTable('attributes', $expectedColumns, $this->connection);
    }

    public function testTenantAttributeValueTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'attribute_category_id',
            'attribute_id',
            'value',
            'attribute_type',
        ];
        $this->testMigrationsTable('attribute_value', $expectedColumns, $this->connection);
    }

    public function testTenantAttributeOptionsTableHasExpectedColumns()
    {
        $expectedColumns = [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'attributable_type',
            'attributable_id',
            'attribute_id',
        ];
        $this->testMigrationsTable('attribute_options', $expectedColumns, $this->connection);
    }
}
