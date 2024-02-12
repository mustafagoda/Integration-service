<?php

declare(strict_types=1);

namespace Tests\Unit\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class SupplierActionsCommandTest extends TestCase
{
    private string $servicePath = 'app/Domain/Tenant/';

    public function testCommandCanCreatesIntegrationDirectoriesAndFiles()
    {
        $serviceName = 'ExampleService';

        $this->servicePath .= $serviceName;
        $supplierName = 'ExampleSupplier';
        $action = 'ExampleAction';

        Artisan::call('supplier', [
            'serviceName' => $serviceName,
            'supplierName' => $supplierName,
            'action' => $action,
        ]);

        $supplierPath = "app/Domain/Tenant/{$serviceName}/Suppliers/{$supplierName}";
        $actionPath = "{$supplierPath}/Workflow/{$action}";

        $this->assertDirectoryExists($supplierPath);
        $this->assertDirectoryExists("{$supplierPath}/Workflow");
        $this->assertDirectoryExists($actionPath);

        $this->assertFileExists("{$actionPath}/{$action}Request.php");
        $this->assertFileExists("{$actionPath}/{$action}Response.php");
        $this->assertFileExists("{$actionPath}/{$action}.php");

        $this->assertFileContains("{$actionPath}/{$action}Request.php", [$serviceName, $supplierName, $action]);
        $this->assertFileContains("{$actionPath}/{$action}Response.php", [$serviceName, $supplierName, $action]);
        $this->assertFileContains("{$actionPath}/{$action}.php", [$serviceName, $supplierName, $action]);
    }

    public function testCommandCanHandlesExistingDirectoriesGracefully()
    {
        $serviceName = 'ExistingService';
        $this->servicePath .= $serviceName;
        $supplierName = 'ExistingSupplier';
        $action = 'ExistingAction';

        Artisan::call('supplier', [
            'serviceName' => $serviceName,
            'supplierName' => $supplierName,
            'action' => $action,
        ]);

        Artisan::call('supplier', [
            'serviceName' => $serviceName,
            'supplierName' => $supplierName,
            'action' => $action,
        ]);

        $supplierPath = "app/Domain/Tenant/{$serviceName}/Suppliers/{$supplierName}";
        $actionPath = "{$supplierPath}/Workflow/{$action}";

        $this->assertDirectoryExists($supplierPath);
        $this->assertDirectoryExists("{$supplierPath}/Workflow");
        $this->assertDirectoryExists($actionPath);

        $this->assertFileExists("{$actionPath}/{$action}Request.php");
        $this->assertFileExists("{$actionPath}/{$action}Response.php");
        $this->assertFileExists("{$actionPath}/{$action}.php");
    }

    protected function assertFileContains($filePath, array $content): void
    {
        $fileContents = file_get_contents($filePath);

        foreach ($content as $expected) {
            $this->assertStringContainsString($expected, $fileContents);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if ($this->servicePath !== 'app/Domain/Tenant/') {
            $this->removeDirectory($this->servicePath);
        }
    }
}
