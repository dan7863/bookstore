<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence;
        $min_number = 50;
        $max_number = 2000;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'isbn' => $this->faker->isbn13('-'),
            'page_count' => $this->faker->numberBetween($min_number, $max_number),
            'url' => $this->faker->url(),
            'publisher_id' => Publisher::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
