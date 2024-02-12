<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;

class CreateTenantDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:db {dbname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database for every tenant';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $dbname = (string) $this->argument('dbname') ?? null;

            if (empty($dbname)) {
                throw new InvalidArgumentException("Database name cannot be empty.");
            }

            $schemaExists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$dbname]);

            if (! empty($schemaExists)) {
                $this->line("Database $dbname already exists.");
            } else {
                DB::disconnect();
                DB::purge('tenant');
                DB::reconnect('tenant');
                Schema::createDatabase($dbname);
                $this->line("Database $dbname created");
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        reset_landlord_connection();
    }
}
