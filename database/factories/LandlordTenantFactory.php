<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LandlordTenantFactory extends Factory
{
    public function definition(): array
    {
        $tenantName = fake()->name();
        return [
            'created_by' => User::factory()->create()->id,
            'name' => $tenantName,
            'slug' => Str::slug($tenantName),
            'database' => '',
            'domain' => fake()->unique()->domainName(),
        ];
    }
}
