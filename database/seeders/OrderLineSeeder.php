<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\OrderInvoice;
use App\Models\OrderLine;
use App\Models\PurchaseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_lines = OrderLine::factory(50)->create();

        foreach($order_lines as $order_line){
            PurchaseOrder::create([
                'book_id' => Book::has('book_purchase_detail')->with('book_purchase_detail')->get()->random()->id,
                'order_line_id' => $order_line->id
            ]);

            OrderInvoice::factory(1)->create([
                'order_line_id' => $order_line->id
            ]);
        }
    }
}
