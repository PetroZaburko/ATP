<?php

use App\Http\Controllers\CandidateController;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('users', ['uses' => 'App\\Http\\Controllers\\Voyager\\VoyagerUserController@index', 'as' => 'voyager.users.index']);
    Route::get('candidate', [CandidateController::class, 'index'])->name('candidate.index');
    Route::post('candidate', [CandidateController::class, 'store'])->name('candidate.store');
});
