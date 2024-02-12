<?php

namespace Database\Factories\Tenant;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->currencyCode,
            'slug' => fake()->unique()->currencyCode,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'is_default' => false,
            'icon' => fake()->filePath()
        ];
    }
}
