<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksStoreController;

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

Route::get('/', [BooksStoreController::class, 'index'])->name('books_store.index');

Route::get('books/store/{book}', [BooksStoreController::class, 'show'])->name('books_store.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
