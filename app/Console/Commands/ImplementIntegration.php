<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImplementIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrate {serviceName} {supplierName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'implement integration contracts';

    /**
     * @return void
     */
    public function handle(): void
    {
        $serviceName = Str::ucfirst($this->argument('serviceName'));
        $servicePath = 'app/Domain/Tenant/' . $serviceName;
        if (! is_dir($servicePath)) {
            mkdir($servicePath, 0775, true);
            mkdir($servicePath . '/DTO', 0775, true);
            mkdir($servicePath . '/Enum', 0775, true);
            mkdir($servicePath . '/Injectors', 0775, true);
            mkdir($servicePath . '/Services', 0775, true);
            mkdir($servicePath . '/Suppliers', 0775, true);
        }
        $supplierName = $this->argument('supplierName');

        $andSupplier = '';

        if (! empty($supplierName)) {
            $supplierName = Str::ucfirst($this->argument('supplierName'));
            $supplierPath = 'app/Domain/Tenant/' . $serviceName . '/Suppliers/' . $supplierName;
            if (! is_dir($supplierPath)) {
                mkdir($supplierPath, 0775, true);
                mkdir($supplierPath . '/Workflow', 0775, true);
            }

            $file = fopen($supplierPath . '/' . $supplierName . '.php', "w");
            $template = Storage::get('IntegrationStubs/SupplierClassStubs');
            $replacedTemplate = str_replace(['{$serviceName}', '{$supplierName}'], [$serviceName, $supplierName], $template);
            fwrite($file, $replacedTemplate);
            fclose($file);

            $andSupplier = "and $supplierName ";
        }

        $this->info("Integration contracts for " . $serviceName . $andSupplier . "implemented successfully.");
    }
}
