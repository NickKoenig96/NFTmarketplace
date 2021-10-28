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
        $cat = '';
        //dd($category);
        if($category == 'Collections'){
            $data['category'] = $category;
            $collections = Collection::where('title', 'LIKE', '%'.$searchText.'%')->get();
            $data['collections'] = $collections;
            return view("nft/search", $data);

        }else{

            $data['category'] = $category;
            $nfts = Nft::where('title', 'LIKE', '%'.$searchText.'%')->get();
            $data['nfts'] = $nfts;

            return view("nft/search", $data);
        }

    }

    
        function index()
        {
        return view('typeahead_autocomplete');
        }
    


    function action(Request $request)
    {

        $category = $request->category;

        if($category == "NFTs"){
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
