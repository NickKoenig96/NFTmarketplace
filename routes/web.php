<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageTest;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\walletController;
use App\Http\Controllers\NftController;







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





//nft
Route::get('/nft', [NftController::class, "index"]);
Route::get('/delete/nft/{id}', [NftController::class, "destroy"]);
Route::get('/nft/addNft', [NftController::class, "create"]);
Route::post('/nft/addNft', [NftController::class, "store"]);
Route::get('/edit/nft/{id}', [NftController::class, "show"]);
Route::post('/nft/editNft', [NftController::class, "edit"]);





//colection
Route::get('/collection', [CollectionController::class, "index"]);
Route::get('/delete/{id}', [CollectionController::class, "destroy"]);
Route::get('/edit/{id}', [CollectionController::class, "show"]);
Route::post('/collection/editCollection', [CollectionController::class, "edit"]);
Route::get('/collection/addCollection', [CollectionController::class, "create"]);
Route::post('/collection/addCollection', [CollectionController::class, "store"]);


//wallet
Route::get('/wallet', [walletController::class, "index"]);



















