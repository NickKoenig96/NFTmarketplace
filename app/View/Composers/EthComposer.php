<?php

namespace App\View\Composers;

use App\Models\User;
use App\Models\Rate;
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
        $rate = Rate::find(1);
        $eth = $rate->rate;
        $view->with('eth', $eth);
    }
}