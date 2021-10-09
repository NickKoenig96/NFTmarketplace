<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(){
        $name = "Jonathan Verhaegen";
        $user = \DB::table("users")->where('name', $name)->first();
        $data['user'] = $user;
        return view('profile', $data);

    }

    
}
