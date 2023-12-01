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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
