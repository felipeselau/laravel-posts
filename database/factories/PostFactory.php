<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'imagem' => 'https://via.assets.so/img.jpg?w=296&h=296&tc=&bg=#cecece',
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['aviso', 'noticia', 'recado', 'geral']),
        ];
    }
}
