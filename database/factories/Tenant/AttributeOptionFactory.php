<?php

namespace Database\Factories\Tenant;

use App\Domain\Shared\Enum\ActiveStatusEnum;
use App\Models\Currency;
use App\Models\Tenant\AttributeOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttributeOption>
 */
class AttributeOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attributable_type' => $this->faker->randomElement([Currency::class]),
            'attributable_id' => function ($attributes) {
                $class = $attributes['attributable_type'];
                return $class::factory()->create()->id;
            },
        ];
    }
}
