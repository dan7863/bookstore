<?php

namespace Database\Seeders;

use App\Models\Description;
use App\Models\Subgender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubgenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subgenders = Subgender::factory(4)->create();

        foreach($subgenders as $gender){
            Description::factory(1)->create([
                'describeable_id' => $gender->id,
                'describeable_type' => Subgender::class
            ]);
        }
    }
}
