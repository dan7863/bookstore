<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\Description;
use App\Models\Format;
use App\Models\Image;
use App\Models\Language;
use App\Models\ProgressState;
use App\Models\Publisher;
use App\Models\Subgender;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kiwilan\Ebook\Ebook;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BookService
{
    public function processFile($url){
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

    public function saveImage($image){
        $image = base64_decode($image);
        $file_name =  hash('sha256', uniqid('imagen_', true)) . '.jpeg';
        $images_path = storage_path('app/public/image_books');
        $file_path = $images_path . '/' . $file_name;
        if (!file_exists($images_path)) {
            mkdir($images_path, 0755, true);
        }
        file_put_contents($file_path, $image);
        return 'image_books/' . $file_name;
    }

    //Stores books with its respective relations
    public function createBook(Request $request)
    {
        $auth_id = auth()->id();
        $book = Book::create([
            'title' => $request->title,
            'slug' => $request->slug . '-' . $auth_id,
            'isbn' => $request->isbn,
            'page_count' => $request->page_count,
            'publisher_id' => $this->getRelationId($request->publisher, 'publisher'),
            'author_id' =>  $this->getRelationId($request->author, 'author'),
            'language_id' =>  $this->getRelationId($request->language, 'language'),
            'user_id' => $auth_id
        ]);

        $this->createImage($request->image, $book->id);
        $this->createDescription($request->description, $book->id);
        $subgenders = $this->getSubgendersId($request->subgenders);
        if(!empty($subgenders)){
            $book->subgenders()->attach($subgenders);
        }
        $type = $this->getTypeId($request->format);
        $url_file = 'ebooks/'.auth()->id().'/'.$request->file_name.$request->format;
        if(!empty($type)){
            $book->types()->attach(
                [$type->id => [
                    'url' => $url_file]
                ]
            );
        }
        $this->createProgressState($book->id);
        $temporal_file_path = storage_path('app/public/temporal/'.auth()->id()
        .'/'.$request->file_name.$request->format);
        chmod($temporal_file_path, 0777);
        
        $path = storage_path('app/public/ebooks/'.$auth_id);

        !file_exists($path) ?  mkdir($path, 0777, true) : '';
        
        $url_file = storage_path('app/public/'.$url_file);
        rename($temporal_file_path, $url_file);
    }


    public function getRelationId($name, $model){
        if(!empty($name)){
            $name = ucwords($name);
            switch($model){
                case $model == 'publisher':
                    $item = Publisher::firstOrCreate(
                        ['name' => $name,
                        'slug' => Str::slug($name)
                    ]);
                break;
                case $model == 'author':
                    $item = Author::firstOrCreate(
                        ['name' => $name,
                        'slug' => Str::slug($name)
                    ]);
                break;
                case $model == 'language':
                    $item = Language::firstOrCreate(
                        ['language' => $name
                    ]);
                break;
                default:
                    throw new \InvalidArgumentException('Invalid Model: ' . $model);
            }
            return $item->id;
        }
       
        return null;
    }

    public function createDescription($description, $book_id){
        if(!empty($description)){
            Description::create([
                'description' => $description,
                'describeable_id' => $book_id,
                'describeable_type' => Book::class
            ]);
        }
    }

    public function createImage($image, $book_id){
        $image_url = $this->saveImage($image);

        Image::create([
            'url' => $image_url,
            'imageable_id' => $book_id,
            'imageable_type' => Book::class
        ]);
    }

    public function createProgressState($book_id){
        ProgressState::create([
            'progress_stateable_id' => $book_id,
            'progress_stateable_type' => Book::class
        ]);
    }

    public function getSubgendersId($subgenders){
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

    public function getTypeId($format){
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
