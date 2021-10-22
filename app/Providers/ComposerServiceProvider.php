<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\EthComposer;
use App\Views\Composers\MultiComposer;



class ComposerServiceProvider extends ServiceProvider
{
 /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        

     // Using class based composers...
     View::composer(['homepage','nft/index', 'nft/showAllNfts', 'nft/search'], EthComposer::class);


    }
}
