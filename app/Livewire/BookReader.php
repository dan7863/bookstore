<?php

namespace App\Livewire;

use Kiwilan\Ebook\Ebook;
use Livewire\Component;

class BookReader extends Component
{

    public $book;
    public $content;
    public $numberFile;
    public $css;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $book_types = $this->book->types;
        if(empty($this->numberFile)){
            $this->numberFile = 0;
        }
        foreach ($book_types as $b_type) {
            $url = storage_path('app/public/'.$b_type->pivot->url);
            $is_valid = Ebook::isValid($url);
            if($is_valid){
                $ebook = Ebook::read($url);
                $files = $ebook->getArchive()->getFiles();
                foreach($files as $index => $file){
                    if(str_contains($files[$index], '.css')){
                        $this->css .= '<div>'.$ebook->getArchive()->getText($file).'</div>';
                    }
                }
                if(str_contains($files[$this->numberFile], 'jpg')
                || str_contains($files[$this->numberFile], 'png')
                || str_contains($files[$this->numberFile], 'jpeg')){
                    $img = base64_encode($ebook->getArchive()->getContents($files[$this->numberFile]));
                    $this->content = '<div class = "text-center"><img src = "data:image/png;base64,'.$img.'"></div>';
                }
                else{
                    $this->content = '<div>'.$ebook->getArchive()->getText($files[$this->numberFile]).'</div>';
                }
            }
        }
        return view('livewire.book-reader');
    }
}
