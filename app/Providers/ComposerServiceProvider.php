<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\EthComposer;


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
     View::composer('nft/index', EthComposer::class);


    }
}
