<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\LandlordTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateTenantDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenantDB?} {--fresh} {--seed} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate tenants database';

    /**
     * @return void
     */
    public function handle(): void
    {
        if ($tenantDbName = $this->argument('tenantDB')) {
            $this->migrate($tenantDbName);
        } else {
            LandlordTenant::get()->each(
                fn ($tenant) => $this->migrate($tenant->database)
            );
        }
    }

    /**
     * @param string $tenantDbName
     * @return void
     */
    private function migrate(string $tenantDbName): void
    {
        config([
            'database.connections.tenant.database' => $tenantDbName,
        ]);
        DB::disconnect();
        DB::purge('tenant');
        DB::reconnect('tenant');

        $this->line('');
        $this->line("-----------------------------------------");
        $this->info("Migrating $tenantDbName");

        $options = [
            '--force' => true,
            '--path' => config('multitenancy.migrations.path'),
            '--database' => 'tenant',
        ];

        if ($this->option('seed')) {
            $options['--seed'] = true;
            $options['--seeder'] = config('multitenancy.seeder.class');
        }

        if ($this->option('refresh')) {
            Artisan::call('migrate:refresh', $options);
        } else {
            Artisan::call(
                $this->option('fresh') ? 'migrate:fresh' : 'migrate',
                $options
            );
        }

        $this->info("$tenantDbName Migrated");
        $this->line("-----------------------------------------");
    }
}
