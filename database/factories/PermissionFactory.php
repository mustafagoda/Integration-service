<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{

    public function definition(): array
    {
        return [
            'permission_group' => fake('en')->unique()->slug(),
            'slug' => fake('en')->unique()->slug(),
            'name' => fake('en')->unique()->text,
        ];
    }
}
