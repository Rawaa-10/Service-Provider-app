<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
                'provider_id' => User::inRandomOrder()->where('role', 'provider')->value('id') ?? User::factory(), 
                'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),  
                'title' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(4),
                'description' => $this->faker->paragraph(),
                'price' => $this->faker->randomFloat(2, 10, 500),
                'is_active' => $this->faker->boolean(),
        ];
    }
}
