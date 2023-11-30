<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookPurchaseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'signatory' => $this->faker->name,
            'price' => $this->faker->randomFloat(3, 5000, 200000),
            'available_state' => $this->faker->numberBetween(0, 1),
            'book_id' => Book::all()->random()->id
        ];
    }
}
