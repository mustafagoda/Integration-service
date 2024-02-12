<?php

namespace Database\Factories\Tenant;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Tenant\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::random(10);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => ActiveStatusEnum::ACTIVE->value,
            'type' => 'text',
            'placeholder' => fake()->paragraph,
            'tooltip' => fake()->paragraph,
            'validation' => json_encode(['required']),
            'icon' => null
        ];
    }
}
