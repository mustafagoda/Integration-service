<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{

    public function definition(): array
    {
        return [
            'slug' => fake('en')->unique()->slug(),
            'name' => fake('en')->unique()->text,
        ];
    }
}
