<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'type' => 'ebook',
            'format_id' => 1 // .epub position on $initial_formats array from FormatSeeder
        ]);

        Type::create([
            'type' => 'ebook',
            'format_id' => 2 // .pdf position on $initial_formats array from FormatSeeder
        ]);

        Type::create([
            'type' => 'audiobook',
            'format_id' => 3 // .mp3 position on $initial_formats array from FormatSeeder
        ]);
    }
}
