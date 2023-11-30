<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initial_formats = ['.epub', '.pdf', '.mp3'];
        foreach($initial_formats as $format){
            Format::create([
                'format' => $format
            ]);
        }
       
    }
}
