<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SupplierActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supplier {serviceName} {supplierName} {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'implement integration';

    /**
     * @return void
     */
    public function handle(): void
    {
        $serviceName = Str::ucfirst($this->argument('serviceName'));
        $supplierName = Str::ucfirst($this->argument('supplierName'));
        $action = Str::ucfirst($this->argument('action'));
        $supplierPath = 'app/Domain/Tenant/' . $serviceName . '/Suppliers/' . $supplierName;
        if (! is_dir($supplierPath)) {
            mkdir($supplierPath, 0775, true);
        }

        if (! is_dir($supplierPath . '/Workflow')) {
            mkdir($supplierPath . '/Workflow', 0775, true);
            mkdir($supplierPath . '/Workflow/' . $action, 0775, true);
        }

        if (! is_dir($supplierPath . '/Workflow/' . $action)) {
            mkdir($supplierPath . '/Workflow/' . $action, 0775, true);
        }

        $file = fopen($supplierPath . '/Workflow/' . $action . '/' . $action . 'Request.php', "w");
        $template = Storage::get('IntegrationStubs/SupplierActionRequestStubs');
        $replacedTemplate = str_replace(['{$serviceName}', '{$supplierName}', '{$action}'], [$serviceName, $supplierName, $action], $template);
        fwrite($file, $replacedTemplate);

        $file = fopen($supplierPath . '/Workflow/' . $action . '/' . $action . 'Response.php', "w");
        $template = Storage::get('IntegrationStubs/SupplierActionResponseStubs');
        $replacedTemplate = str_replace(['{$serviceName}', '{$supplierName}', '{$action}'], [$serviceName, $supplierName, $action], $template);
        fwrite($file, $replacedTemplate);

        $file = fopen($supplierPath . '/Workflow/' . $action . '/' . $action . '.php', "w");
        $template = Storage::get('IntegrationStubs/SupplierActionStubs');
        $replacedTemplate = str_replace(['{$serviceName}', '{$supplierName}', '{$action}'], [$serviceName, $supplierName, $action], $template);
        fwrite($file, $replacedTemplate);

        fclose($file);
    }
}
