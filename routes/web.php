<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageTest;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\walletController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\apiController;



use App\Views\Composers\MultiComposer;










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

// homepage
Route::get('/', [NftController::class, "homepage"]);

// detail page from homepage
Route::get('/nfts/{id}', [NftController::class, "showAllNfts"]);



//login and register
Route::get('/signup', [UserController::class, "register" ]);
Route::post('/users/signup', [UserController::class, "store"]);
Route::get('/login', [UserController::class, "login"]);
Route::post('/users/login', [UserController::class, "handleLogin"]);
Route::get('/logout', [Usercontroller::class, "logout"]);





//profile
Route::get('/profile', [UserController::class, "profile"]);
Route::post('/profile/updateUserdata', [UserController::class, "updateUserdata"]);
Route::post('/profile/updateAvatar', [UserController::class, "updateAvatar"]);



//search
Route::get('/search', [SearchController::class, "search"]);
Route::get('/homepage', [SearchController::class, 'index']);
Route::get('/homepage/action', [SearchController::class, 'action'])->name('typeahead_autocomplete.action');



//nft
Route::get('/nft', [NftController::class, "index"]);
Route::get('/delete/nft/{id}', [NftController::class, "destroy"]);
Route::get('/nft/addNft', [NftController::class, "create"]);
Route::post('/nft/addNft', [NftController::class, "store"]);
Route::get('/edit/nft/{id}', [NftController::class, "show"]);
Route::post('/nft/editNft', [NftController::class, "edit"]);
Route::post('/nft/buy', [NftController::class, "buy"]);


//collection
Route::get('/collection', [CollectionController::class, "index"]);
Route::get('/delete/{id}', [CollectionController::class, "destroy"]);
Route::get('/edit/{id}', [CollectionController::class, "show"]);
Route::post('/collection/editCollection', [CollectionController::class, "edit"]);
Route::get('/collection/addCollection', [CollectionController::class, "create"]);
Route::post('/collection/addCollection', [CollectionController::class, "store"]);


//wallet
Route::get('/wallet', [walletController::class, "index"]);
