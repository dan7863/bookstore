<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Language;
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
        $user_id = Author::all()->random()->id;
        $min_number = 50;
        $max_number = 2000;
        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . $user_id),
            'isbn' => $this->faker->isbn13('-'),
            'page_count' => $this->faker->numberBetween($min_number, $max_number),
            'publisher_id' => Publisher::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'user_id' => $user_id,
            'language_id' => Language::all()->random()->id
        ];
    }
}
