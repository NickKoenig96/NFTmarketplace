<?php

namespace App\View\Composers;

use Illuminate\View\View;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EthComposer
{
     
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $eth =  Http::get('https://min-api.cryptocompare.com/data/price?fsym=EUR&tsyms=ETH')['ETH'];
        $view->with('eth', $eth);
    }
}