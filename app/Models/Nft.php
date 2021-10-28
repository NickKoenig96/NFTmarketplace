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
}
