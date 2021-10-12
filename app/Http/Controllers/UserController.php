<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;


class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(){
        $id = 4;
        $user = \DB::table("users")->where('id', $id)->first();
        $data['user'] = $user;
        return view('profile', $data);

    }

    public function updateAvatar(Request $req){
        if($req->hasFile('avatar')){
            $avatar = $req->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('../public/images/'.$filename);
            Image::make($avatar)->resize(300, 300)->save($path);

            $user = User::find($req->id);
            $user->avatar = $filename;
            $user->save();
            return redirect('./profile');

           
        }

        
    }

    public function updateUserdata(Request $req){
        
        $user = User::find($req->id);
        $user->firstname = $req->input('firstname');
        $user->lastname = $req->input('lastname');
        $user->email = $req->input('email');
        $user->save();
        return redirect('./profile');
    }

    
}
