<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function nft(){
        return $this->belongsTo(\App\Models\Nft::class);
    }

    public function seller(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function buyer(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
