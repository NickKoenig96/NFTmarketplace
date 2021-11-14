<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nft;
use App\Models\Collection;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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

            // $image = $request->file('avatar');
            
            // $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySW5mb3JtYXRpb24iOnsiaWQiOiJlODU4Y2FjNS0yNjQ4LTRmYzEtYmZlMC0wYWFiMDVjODM4N2EiLCJlbWFpbCI6ImpvbmF0aGFuX3ZlcmhhZWdlbkBob3RtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaW5fcG9saWN5Ijp7InJlZ2lvbnMiOlt7ImlkIjoiRlJBMSIsImRlc2lyZWRSZXBsaWNhdGlvbkNvdW50IjoxfV0sInZlcnNpb24iOjF9LCJtZmFfZW5hYmxlZCI6ZmFsc2V9LCJhdXRoZW50aWNhdGlvblR5cGUiOiJzY29wZWRLZXkiLCJzY29wZWRLZXlLZXkiOiI1ODk3ZjdlNzI5YWY2MTI4MmEzMyIsInNjb3BlZEtleVNlY3JldCI6IjY0YjQ4YTQ5NDQwMTc5NTJjMzlmYzZkZTUxNzk1NjI3NjdkZjY2Mjg3N2RiMGZhYWU0Y2NjYTIzMzdkZGE2MTIiLCJpYXQiOjE2MzU5NTc4MDV9.gEhDh3rJNqr1rbUp6u4X6y_6kkUSxmBEipuoVjVdGFQ";
            
            // $response = Http::withToken($token)->attach('attachment', file_get_contents($image))->post('https://api.pinata.cloud/pinning/pinFileToIPFS', ['file' => fopen($image, "r")]);

            

            // return $response->json();
            

            $user = User::find($request->id);
            $user->avatar = $uploadedFileUrl;


            $user->save();
            $request->session()->flash('message', 'Profile picture has been changed successfully');
            return redirect('./profile');

           
        }

        
    }

    public function updateUserdata(Request $request){
        
        $user = User::find($request->id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        $request->session()->flash('message', 'Profile has been changed successfully');
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
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);


        $user = new \App\Models\User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        // if($request->input('password') === $request->input('confirmPassword')){
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            if (Auth::attempt($credentials)) {
                return redirect()->intended('./');
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
