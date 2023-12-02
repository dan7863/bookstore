<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GenderController;
use App\Http\Controllers\Admin\SubgenderController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('genders', GenderController::class)->names('admin.genders');

Route::resource('subgenders', SubgenderController::class)->names('admin.subgenders');

Route::resource('books', BookController::class)->names('admin.books');


?>