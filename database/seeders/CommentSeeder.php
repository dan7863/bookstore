<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookPurchaseDetail;
use App\Models\Comment;
use App\Models\OrderLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book_purchase_details = BookPurchaseDetail::all();
        foreach($book_purchase_details as $bp_detail){
            $order_lines = OrderLine::with('purchase_orders.book')
            ->whereHas('purchase_orders', function ($query) use ($bp_detail) {
                $query->where('book_id', $bp_detail->book_id);
            })
            ->get();
            
            if (!$order_lines->isEmpty()) {
                foreach($order_lines as $order_line){
                    Comment::factory(1)->create([
                        'commentable_id' => $bp_detail->book_id,
                        'commentable_type' => Book::class, // Use the class name as a string
                        'user_id' => $order_line->buyer_id
                    ]);
                }
               
            }
        }
    }
}
