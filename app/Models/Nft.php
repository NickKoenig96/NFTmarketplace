<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    //protected $with = ["comments"];

    public function collection(){
        return $this->belongsTo(\App\Models\Collection::class);
    }

    public function comment(){
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }


    public function users(){
        return $this->belongsToMany(\App\Models\User::class);
    }
    // public function favourites(){
    //     return $this->hasMany(Nft_user::class)
    //                     ->where(function ($query){
    //                         if(auth()->check()){
    //                             $query->where('user_id', auth()->user()->id);
    //                         }
    //                     });
    // }
}
