<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GenderController;
use App\Http\Controllers\Admin\SubgenderController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookPurchaseDetailController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('genders', GenderController::class)->names('admin.genders');

Route::resource('subgenders', SubgenderController::class)->names('admin.subgenders');

Route::resource('books', BookController::class)->names('admin.books');

Route::get('books/read/{book}', [BookController::class, 'read'])->name('admin.books.read');

Route::resource('book-purchase-details', BookPurchaseDetailController::class)->names('admin.book-purchase-details');

Route::resource('authors', AuthorController::class)->names('admin.authors');

Route::resource('publishers', PublisherController::class)->names('admin.publishers');

Route::resource('paymenth-methods', PaymentMethodController::class)->names('admin.payment-methods');

Route::get('/process-order/{book}', [PaymentMethodController::class, 'processOrder'])
->name('books_store.process-order');

Route::get('/process-payment', [PaymentMethodController::class, 'processPayment'])
->name('books_store.process-payment');


Route::post('/upload', [BookController::class, 'upload_file'])->name('admin.books.upload.file');

