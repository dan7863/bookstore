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
    public $isImage = false;

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
                $css_files = $ebook->getArchive()->filter('.css');

                if(!empty($css_files)){
                    foreach($css_files as $index => $file){
                        if(str_contains($css_files[$index], '.css')){
                            $this->css .= '<div>'.$ebook->getArchive()->getText($file).'</div>';
                        }
                    }
                }
                
                if(isset($files[$this->numberFile])){
                    if($files[$this->numberFile]->isImage()){
                        $this->isImage = true;
                        $img = base64_encode($ebook->getArchive()->getContents($files[$this->numberFile]));
                        $this->content = '
                        <div class = "text-center">
                            <img class = "w-60" src = "data:image/png;base64,'.$img.'">
                        </div>';
                    }
                    else{
                        $this->content = '<div>'.$ebook->getArchive()->getText($files[$this->numberFile]).'</div>';
                    }
                }
            }
        }
        return view('livewire.book-reader');
    }
}
