<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'filmout'], function () {
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}', [FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}', [FilmController::class, "filmsByYear"])->name('listByYear');
        Route::get('filmsByGenre/{genre?}', [FilmController::class, "filmsByGenre"])->name('listByGenre');
        Route::get('sortFilms', [FilmController::class, "sortByYear"])->name('sortByYear');
        Route::get('countFilms', [FilmController::class, "countFilms"])->name('listCount');
    });
    Route::group(['prefix' => 'actorout'], function () {

        Route::get('/actors', [ActorController::class, 'listActors']);
        Route::get('listActorsByDecade/{year?}', [ActorController::class, 'listActorsByDecade'])
            ->where('year', '\d{4}') // Ensure that 'year' is a four-digit number
            ->name('listActorsByDecade');
        Route::get('countActors',[ActorController:: class, 'countActors']);

    });
});

Route::middleware('validateUrl')->group(function () {
    Route::group(['prefix' => 'filmin'], function () {
        Route::post('createFilm', [FilmController::class, "createFilm"])->name('createFilm');
    });
});
