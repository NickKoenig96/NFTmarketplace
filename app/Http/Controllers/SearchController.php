<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\Collection;

class SearchController extends Controller
{

    public function search(Request $request){
        $searchText = $_GET["searchTerm"];
        $category = $request->input('category');
        //dd($category);
        if($category == 'Collections'){
            $data = Collection::where('title', 'LIKE', '%'.$searchText.'%')->get();

            return view("/search", compact("data"));

        }else{
            $data = Nft::where('title', 'LIKE', '%'.$searchText.'%')->get();

            return view("/search", compact("data"));
        }

    }

    
        function index()
        {
        return view('typeahead_autocomplete');
        }
    


    function action(Request $request)
    {

        $category = $request->category;

        if($category == "NFT's"){
            $data = Nft::select('title')
            ->where('title', 'like', "%{$request->term}%")
            ->pluck('title');
            return $data;

        }else{
            $data = Collection::select('title')
            ->where('title', 'like', "%{$request->term}%")
            ->pluck('title');
            return $data;

        }

    }
}
