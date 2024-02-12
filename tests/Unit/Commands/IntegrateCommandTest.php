<?php

declare(strict_types=1);

namespace Tests\Unit\Commands;

use Tests\TestCase;

class IntegrateCommandTest extends TestCase
{
    private string $servicePath = '';

    public function testCommandCanCreatesIntegrationDirectoriesAndFiles()
    {
        $serviceName = 'ExampleService';
        $supplierName = 'ExampleSupplier';

        $this->artisan('integrate', [
            'serviceName' => $serviceName,
            'supplierName' => $supplierName,
        ])->assertExitCode(0);
        $this->servicePath = 'app/Domain/Tenant/' . ucfirst($serviceName);
        $supplierPath = "$this->servicePath/Suppliers/" . ucfirst($supplierName);
        $supplierFilePath = "$supplierPath/$supplierName.php";

        $this->assertDirectoryExists($this->servicePath);
        $this->assertDirectoryExists("$this->servicePath/DTO");
        $this->assertDirectoryExists("$this->servicePath/Enum");
        $this->assertDirectoryExists("$this->servicePath/Injectors");
        $this->assertDirectoryExists("$this->servicePath/Services");
        $this->assertDirectoryExists("$this->servicePath/Suppliers");
        $this->assertDirectoryExists($supplierPath);

        $this->assertFileExists($supplierFilePath);
        $this->assertStringContainsString("class $supplierName", file_get_contents($supplierFilePath));
    }

    public function testCommandCanCreatesIntegrationDirectoriesWithoutSupplierArgument()
    {
        $serviceName = 'ExampleService';

        $this->artisan('integrate', [
            'serviceName' => $serviceName,
        ])
            ->assertExitCode(0);

        $this->servicePath = 'app/Domain/Tenant/' . ucfirst($serviceName);
        $this->assertDirectoryExists($this->servicePath);
        $this->assertDirectoryExists("$this->servicePath/DTO");
        $this->assertDirectoryExists("$this->servicePath/Enum");
        $this->assertDirectoryExists("$this->servicePath/Injectors");
        $this->assertDirectoryExists("$this->servicePath/Services");
        $this->assertDirectoryExists("$this->servicePath/Suppliers");
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->removeDirectory($this->servicePath);
    }
}
