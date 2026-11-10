<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'bio' => $this->faker->optional()->paragraph(),
            'image' => $this->faker->optional()->imageUrl(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'created_at' => $createdAt = $this->faker->dateTimeThisDecade(),
            'updated_at' => $this->faker->optional(50, $createdAt)
                ->dateTimeBetween($createdAt),
        ];
    }
}
