<?php

declare(strict_types=1);

namespace Database\Seeders\tenant;

use App\Models\User;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\LanguageSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'tenant.admin@travware.com',
        ]);
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            DynamicSettingSeeder::class,
        ]);
    }
}
