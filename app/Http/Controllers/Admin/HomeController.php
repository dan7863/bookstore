<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Gender;
use App\Models\Publisher;
use App\Models\Subgender;
use App\Traits\Cacheable;
use App\Traits\Sessionable;

class HomeController extends Controller
{
    use Cacheable;
    use Sessionable;

    public function index(){
        $gendersCount = $this->getFromCacheOrCalculate('gendersCount', function () {
            return Gender::count();
        });

        $subgendersCount = $this->getFromCacheOrCalculate('subgendersCount', function () {
            return Subgender::count();
        });

        $authorsCount = $this->getFromCacheOrCalculate('authorsCount', function () {
            return Author::count();
        });

        $publishersCount = $this->getFromCacheOrCalculate('publishersCount', function () {
            return Publisher::count();
        });

        $uploadsCount = $this->getFromSessionOrCalculate('uploadsCount', function () {
            return Book::where('user_id', auth()->id())->whereDoesntHave('book_purchase_detail')->count();
        });

        $purchaseDetailsCount = $this->getFromSessionOrCalculate('purchaseDetailsCount', function () {
            return Book::where('user_id', auth()->id())->whereHas('book_purchase_detail')->count();
        });

        $purchaseOrdersCount = $this->getFromSessionOrCalculate('purchaseOrdersCount', function () {
            return Book::whereHas('purchase_orders', function ($query) {
                $query->whereHas('order_line', function ($subquery) {
                    $subquery->where('user_id', auth()->id());
                });
            })->count();
        });

        return view('admin.index', compact('gendersCount', 'subgendersCount',
        'authorsCount', 'publishersCount', 'uploadsCount', 'purchaseDetailsCount',
        'purchaseOrdersCount'
    ));
    }
}
