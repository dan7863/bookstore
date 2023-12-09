<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookPurchaseDetail;
use App\Models\Comment;
use App\Models\OrderLine;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookPurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookPurchaseDetail::factory(25)->create();
    }
}
