<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\OrderLine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
  use HandlesAuthorization;
  public function user(User $user, Book $book){
        if($user->id == $book->user_id){
            return true;
        }

        return false;
  }

  public function userOrPurchased(User $user, Book $book){
    $buyed_book = OrderLine::whereHas('purchase_orders', function ($query) use ($book) {
        $query->where('book_id', $book->id);
    })->where('buyer_id', $user->id)->exists();

    if($user->id == $book->user_id || $buyed_book){
        return true;
    }
    return false;
  }

    
  public function available(?User $user, Book $book){
    if($book->book_purchase_detail->available_state == 1){
        return true;
    }
    return false;
  }
}
