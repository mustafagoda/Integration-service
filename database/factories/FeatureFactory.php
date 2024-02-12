<?php

namespace Database\Factories;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feature>
 */
class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug,
            'name' => fake()->name,
            'description' => fake()->text,
            'status' => ActiveStatusEnum::ACTIVE->value
        ];
    }
}
