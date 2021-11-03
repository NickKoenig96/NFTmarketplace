<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nft;
use App\Models\Collection;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(){
        // $id = 4;
        $user = Auth::user();
        $userId = $user["id"];
        $nfts = Nft::where("owner_id", $userId)->get();
        $collections = Collection::where("creator_id", $userId)->get();
        // $user = \DB::table("users")->where('id', $id)->first();
        $data['user'] = $user;
        $data['nfts'] = $nfts;
        $data['collections'] = $collections;
        return view('profile', $data);

    }

    public function updateAvatar(Request $request){
        if($request->hasFile('avatar')){
            
            $uploadedFileUrl = \Cloudinary::upload($request->file('avatar')->getRealPath())->getSecurePath();
            

            $user = User::find($request->id);
            $user->avatar = $uploadedFileUrl;


            $user->save();
            return redirect('./profile');

           
        }

        
    }

    public function updateUserdata(Request $request){
        
        $user = User::find($request->id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->street = $request->input('street');
        $user->housenumber = $request->input('housenumber');
        $user->city = $request->input('city');
        $user->postal = $request->input('postal');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->save();
        return redirect('./profile');
    }



    public function register(){
        return view('signup');
    }

    public function login(){
        return view('login');
    }

    public function store(Request $request){
        
        $credentials = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirmPassword' => ['required']
        ]);

        $user = new \App\Models\User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        if($request->password === $request->confirmPassword){
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            if (Auth::attempt($credentials)) {
                return redirect()->intended('./');
            }else{
                return redirect('./login');
            }
        }

        
    }

    public function handleLogin(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('./');
        }else{
            $data['error'] = "Email and password do not match";
            return view('./login', $data);
        }


    }

    public function logout(){
        Auth::logout();
        return redirect('./login');
    }

    
}
