<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ["title", "description", "image_file_path", "created_at", "updated_at"];

   /* protected $with = ["nfts"];

    public function nft(){
        return $this->hasMany(\App\Models\Nft::class);
    }*/
}
