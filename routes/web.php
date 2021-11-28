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
//login and register
    
Route::post('/users/signup', [UserController::class, "store"]);
Route::post('/users/login', [UserController::class, "handleLogin"]);
Route::get('/logout', [Usercontroller::class, "logout"]);
Route::get('/login',  [ UserController::class, "login"])->name("login"); //name meegeven zodat auth middleware een route kan redirecten
Route::get('/signup', [UserController::class, "register" ]);

//eerst langs de auth middleware paseren om te zien of een user is ingelogd
Route::group(['middleware' => ['auth']], function() {

    // homepage
    Route::get('/', [NftController::class, "homepage"]);

    Route::get('/homepageFilter', [NftController::class, "filter"]);

    // detail page from homepage
    Route::get('/nfts/{id}', [NftController::class, "showAllNfts"]);

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
    Route::get('/nft/buy/{id}', [NftController::class, "buyNft"]);
    Route::post('nft/order', [NftController::class, "order"]);
    Route::get('/nft/sell/{id}', [NftController::class, "sell"]);
    Route::post('/nft/markForSale', [NftController::class, "markForSale"]);
    Route::post('/nft/{itemId}/{nftOwner}/{nftId}', [NftController::class, 'addItem']);


    //collection
    Route::get('/collections', [CollectionController::class, "index"]);
    Route::get('/collections/{id}', [CollectionController::class, "showCollection"]);
    Route::get('/delete/{id}', [CollectionController::class, "destroy"]);
    Route::get('/edit/{id}', [CollectionController::class, "show"]);
    Route::post('/collection/editCollection', [CollectionController::class, "edit"]);
    Route::get('/collection/addCollection', [CollectionController::class, "create"]);
    Route::post('/collection/addCollection', [CollectionController::class, "store"]);

    Route::get('/collection/detailCollection', [CollectionController::class, "indexDetail"]);




    //wallet
    Route::get('/wallet', [walletController::class, "index"]);

    
});



