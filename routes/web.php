<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageTest;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\walletController;






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


Route::get('/', function () {
    return view('homepage');
});

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

//wallet
Route::get('/wallet', [walletController::class, "index"]);
//wallet (add/edit/remove collection)
Route::get('/delete/{id}', [walletController::class, "destroy"]);
Route::get('/edit/{id}', [walletController::class, "show"]);
Route::post('/collection/editCollection', [walletController::class, "update"]);
Route::get('/collection/addCollection', [CollectionController::class, "create"]);
Route::post('/collection/addCollection', [CollectionController::class, "store"]);


















