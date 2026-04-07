<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'desc' => fake()->paragraph(),
            'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800',
        ];
    }
}