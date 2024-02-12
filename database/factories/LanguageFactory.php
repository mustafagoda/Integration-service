<?php

namespace Database\Factories;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => ActiveStatusEnum::ACTIVE->value,
            'slug' => Str::slug(Str::random(10)),
            'name' => fake()->word,
            'direction' => 'ltr',
            'is_default' => false,
            'icon' => fake()->filePath()
        ];
    }
}
