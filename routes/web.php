<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\TVHostController;

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

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');
Route::get('/actors', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{id}', [ActorsController::class, 'show'])->name('actors.show');
Route::get('/host/page/{id}', [TVHostController::class, 'show'])->name('host.show');


