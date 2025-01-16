<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/', function () {
    return view('welcome');
});
