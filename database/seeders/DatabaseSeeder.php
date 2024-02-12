<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            LanguageSeeder::class,
            LandlordTenantSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
