<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageTest;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\walletController;
use App\Http\Controllers\homepageController;







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


/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [homepageController::class, "index"]);

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/profile', function () {
    return view('profile');
});


Route::get('/detail', function () {
    return view('detail');
});



//colection
Route::get('/collection', [CollectionController::class, "index"]);
Route::get('/delete/{id}', [CollectionController::class, "destroy"]);
Route::post('/collection/editCollection', [CollectionController::class, "edit"]);
Route::get('/collection/addCollection', [CollectionController::class, "create"]);
Route::post('/collection/addCollection', [CollectionController::class, "store"]);


//wallet
Route::get('/wallet', [walletController::class, "index"]);
Route::get('/edit/{id}', [walletController::class, "show"]);



















