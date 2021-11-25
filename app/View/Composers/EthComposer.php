<?php

namespace App\View\Composers;

use App\Models\User;
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
        
        $user = User::where('id', 5)->first();
        $userid = $user['id'];
        $view->with('eth', $userid);
    }
}