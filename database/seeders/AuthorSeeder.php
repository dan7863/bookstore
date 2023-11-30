<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Description;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::factory(4)->create();

        
        foreach($authors as $author){
            Description::factory(1)->create([
                'describeable_id' => $author->id,
                'describeable_type' => Author::class
            ]);
        }
    }
}
