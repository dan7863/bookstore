<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Description;
use App\Models\Image;
use App\Models\ProgressState;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Generator;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);
        $relative_path = 'public/image_books';
        Storage::deleteDirectory($relative_path);
        Storage::makeDirectory($relative_path);
        $path = storage_path($relative_path);
        !file_exists($path) ?  mkdir($path, 0755, true) : '';
        
        $books = Book::factory(50)->create();

        foreach($books as $book){

            Image::factory(1)->create([
                'imageable_id' => $book->id,
                'imageable_type' => Book::class
            ]);

            Description::factory(1)->create([
                'describeable_id' => $book->id,
                'describeable_type' => Book::class
            ]);

            $states = ['Not Started', 'Ongoing', 'Completed'];
            $state = $faker->randomElement($states);
            ProgressState::create([
                'progress_stateable_id' => $book->id,
                'progress_stateable_type' => Book::class,
                'reading_state' => $state,
                'page_count' => $this->getPageCount($state, $faker, $book->page_count),
            ]);


            $book->subgenders()->attach([
                random_int(1, 4),
            ]);

            $book_id_first_type = Type::find(random_int(1, 3))->format;
            $fake_url_first_type = $faker->url();
            $dot_position_first_type = strrpos($fake_url_first_type, '.');

            $book_id_second_type = Type::find(random_int(1, 3))->format;
            $fake_url_second_type = $faker->url();
            $dot_position_second_type = strrpos($fake_url_second_type, '.');

            $book->types()->attach(
                $book_id_first_type->id,
                ['url' =>  substr_replace($fake_url_first_type,
                $book_id_first_type->format,
                $dot_position_first_type)]);
            $book->types()->attach(
                $book_id_second_type->id,
                ['url' => substr_replace($fake_url_second_type,
                $book_id_second_type->format,
                $dot_position_second_type)]);
        }
    }

    public function getPageCount($state, $faker, $page_count){
        if($state == 'Completed'){
            return $page_count;
        }
        elseif($state == 'OnGoing'){
            return $faker->numberBetween(0, $page_count);
        }
        return 0;
    }
}
