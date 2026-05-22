<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\AnimalsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HelpRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get("/", [PagesController::class, 'home']);
Route::resource('animals', AnimalsController::class);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/help', [PagesController::class, 'help']);
Route::get('/news', [PagesController::class, 'news']);
Route::get('/contacts', [PagesController::class, 'contacts']);

Route::resource('animals.images', ImageController::class)
    ->except(['index', 'show', 'edit', 'update'])
    ->shallow();

Route::resource('applications', ApplicationController::class)
    ->only(['index', 'update', 'destroy'])
    ->middleware('auth');

Route::post('/applications', [ApplicationController::class, 'store'])
    ->name('applications.store');

Route::resource('help_requests', HelpRequestController::class)
    ->only(['index', 'update', 'destroy'])
    ->middleware('auth');

Route::post('/help_requests', [HelpRequestController::class, 'store'])
    ->name('help_requests.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class)
    ->only(['index', 'update']);

Route::resource('profile', ProfileController::class)
    ->only(['index', 'edit', 'update'])
    ->middleware('auth');