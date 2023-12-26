<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\PurchaseOrder;
use Livewire\WithPagination;

class BooksIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public $type;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        switch($this->type){
            case $this->type == 'book-purchase-details':
                $books = Book::with('author')->with('image')->where('user_id', auth()->user()->id)
                ->where('title', 'LIKE', '%'.$this->search.'%')
                ->has('book_purchase_detail')
                ->with('book_purchase_detail')->latest()->paginate(10);
               
            break;
            case $this->type == 'purchase-orders':
                $books = Book::with('author')->with('image')->whereHas('purchase_orders', function($query){
                    $query->whereHas('order_line', function ($subquery){
                        $subquery->where('buyer_id', auth()->id());
                    });
                })
                ->where('title', 'LIKE', '%'.$this->search.'%')
                ->latest()->paginate(10);
            break;
            default:
                $books = Book::with('author')->with('image')->where('user_id', auth()->user()->id)
                ->where('title', 'LIKE', '%'.$this->search.'%')
                ->whereDoesntHave('book_purchase_detail')->latest()->paginate(10);
        }

        return view('livewire.admin.books-index', compact('books'));
    }
}
