<?php

namespace Database\Factories\Tenant;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Tenant\DynamicSetting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<DynamicSetting>
 */
class DynamicSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'slug' => fake()->slug,
            'description' => fake()->text,
            'status' => ActiveStatusEnum::ACTIVE->value,
            'icon' => 'from ui template icons'
        ];
    }
}
