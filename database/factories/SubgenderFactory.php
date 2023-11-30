<?php

namespace Database\Factories;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subgender>
 */
class SubgenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word(20);
        //$genderIds = User::all()->pluck('id')->toArray()
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            // 'gender_id' => $faker->randomElement($genderIds);
            'gender_id' => Gender::all()->random()->id
        ];
    }
}
