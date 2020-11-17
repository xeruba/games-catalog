<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenreController extends Controller
{
    public function getGames($genre_id){
    	try {
    		$genre = Genre::find($genre_id);
    		if ($genre) {
	    		return response()->json(
			        ['message' => $genre->games()->paginate(10)],
			        200
		       	);
	    	}else{
	    		throw new Exception("Genre not found (key: ". $genre->id .")!", 1);
	    	}
    	} catch (Exception $e) {
    		return response()->json(
		        ['message' => "", 'errors' => $e->getMessage()],
		        404
	       	);
    	}
    }
}
