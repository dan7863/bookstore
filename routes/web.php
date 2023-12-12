<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookStoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BookStoreController::class, 'index'])->name('books_store.index');

Route::get('books/store/{book}', [BookStoreController::class, 'show'])->name('books_store.show');

Route::get('subgender/{subgender}', [BookStoreController::class, 'subgender'])->name('books_store.subgender');

Route::get('authors', [BookStoreController::class, 'authorIndex'])->name('books_store.author-index');

Route::get('author/{author}', [BookStoreController::class, 'authorShow'])->name('books_store.author-show');

Route::get('genders', [BookStoreController::class, 'genderIndex'])->name('books_store.gender-index');

Route::get('publishers', [BookStoreController::class, 'publisherIndex'])->name('books_store.publisher-index');

Route::get('publisher/{publisher}', [BookStoreController::class, 'publisherShow'])->name('books_store.publisher-show');

Route::post('books/store/rate/{book}', [BookStoreController::class, 'rateBook'])->name('books_store.rate-book');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
