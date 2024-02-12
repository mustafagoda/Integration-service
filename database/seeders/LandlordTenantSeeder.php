<?php

namespace Database\Seeders;

use App\Models\LandlordTenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandlordTenantSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domain = 'tenant_app.travware.com';
        LandlordTenant::factory()->create(['domain' => $domain, 'database' => get_tenant_db_prefix_by_env().'1']);
    }
}
