<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\Description;
use App\Models\Format;
use App\Models\Image;
use App\Models\Publisher;
use App\Models\Subgender;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kiwilan\Ebook\Ebook;

class BookService
{
    public function process_file($url){
        $is_valid = Ebook::isValid($url);
        if($is_valid){
            $ebook = Ebook::read($url); 
            if($ebook->isArchive()){
                return [
                    'path' => $ebook->getPath(),
                    'file_name' => $ebook->getFilename(),
                    'title' => $ebook->getTitle(),
                    'slug' => $ebook->getMetaTitle()->getSlug(),
                    'author' => $ebook->getAuthorMain(),
                    'description' => $ebook->getDescription(),
                    'publisher' => $ebook->getPublisher(),
                    'page_count' => $ebook->getPagesCount(),
                    'language' => $ebook->getLanguage(),
                    'tags' => $ebook->getTags(),
                    'cover' => $ebook->getCover()->getContents(true),
                    'extension' => $ebook->getExtension()
                ];
            }
        }

        return 'invalid';
    }

    public function save_image($image){
        $image = base64_decode($image);
        $file_name =  md5(uniqid('imagen_', true)) . '.jpeg';
        $images_path = storage_path('app/public/image_books');
        $file_path = $images_path . '/' . $file_name;
        if (!file_exists($images_path)) {
            mkdir($images_path, 0755, true);
        }
        file_put_contents($file_path, $image);
        return 'image_books/' . $file_name;
    }


    public function create_book(Request $request)
    {

        $book = Book::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'isbn' => $request->isbn,
            'page_count' => $request->page_count,
            'publisher_id' => $this->get_publisher_id($request->publisher),
            'author_id' =>  $this->get_author_id($request->author),
            'user_id' => auth()->id()
        ]);

        $this->create_image($request->image, $book->id);
        $this->create_description($request->description, $book->id);
        $subgenders = $this->get_subgenders_ids($request->subgenders);
        if(!empty($subgenders)){
            $book->subgenders()->attach($subgenders);
        }
        $type = $this->get_type_id($request->format);
        if(!empty($type)){
            $book->types()->attach(
                [$type->id => [
                    'url' => 'ebooks/'.auth()->id().'/'.$request->file_name.$request->format]
                ]
            );
        }
    }

    public function get_publisher_id($publisher){
        if(!empty($publisher)){
            $publisher_name = ucwords($publisher);
            $publisher = Publisher::firstOrCreate(
                ['name' => $publisher_name, 
                'slug' => Str::slug($publisher_name)
            ]);
        }

        return $publisher->id;
    }

    public function get_author_id($author){
        if(!empty($author)){
            $author_name = ucwords($author);
            $author = Author::firstOrCreate(
                ['name' => $author_name, 
                'slug' => Str::slug($author_name)
            ]);
        }

        return $author->id;
    }

    public function create_description($description, $book_id){
        if(!empty($description)){
            Description::create([
                'description' => $description,
                'describeable_id' => $book_id,
                'describeable_type' => Book::class
            ]);
        }
    }

    public function create_image($image, $book_id){
        $image_url = $this->save_image($image);

        Image::create([
            'url' => $image_url,
            'imageable_id' => $book_id,
            'imageable_type' => Book::class
        ]);
    }

    public function get_subgenders_ids($subgenders){
        $subgenders_ids = [];
        if(!empty($subgenders)){
            $subgenders = explode('/', $subgenders);
            foreach($subgenders as $subgender){
                $upper_subgender = ucwords($subgender);
                $subgender = Subgender::firstOrCreate(
                    ['name' => $upper_subgender, 
                    'slug' => Str::slug($upper_subgender)
                ]);
                $subgenders_ids[] = $subgender->id;
          
            }
        }
        return $subgenders_ids;
    }

    public function get_type_id($format){
        $type = [];
        if(!empty($format)){
            $upper_format = ucwords($format);
            $format = Format::firstOrCreate(['format' => $upper_format]);
            if($format->format == '.epub'){
                $type = Type::firstOrCreate(['type' => 'Ebook', 'format_id' => $format->id]);
            }
        }

        return $type;
    }
   
   
}


?>