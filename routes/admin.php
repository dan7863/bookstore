<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GenderController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('genders', GenderController::class)->names('admin.genders');

?>