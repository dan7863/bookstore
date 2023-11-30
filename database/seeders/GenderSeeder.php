<?php

namespace Database\Seeders;

use App\Models\Description;
use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = Gender::factory(4)->create();

        foreach($genders as $gender){
            Description::factory(1)->create([
                'describeable_id' => $gender->id,
                'describeable_type' => Gender::class
            ]);
        }
    }
}
