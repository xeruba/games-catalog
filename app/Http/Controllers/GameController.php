<?php

namespace App\Http\Controllers;

use Exception;
use QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\GameRequest;
use Illuminate\Support\Facades\DB;

use App\Game;

class GameController extends Controller
{
    public function show($game_id)
    {
    	$game = Game::find($game_id);
    	if ($game) {
    		return response()->json(
			        $game,
			        200
			       );
    	}else{
    		return response()->json(
			        ['message' => "Game not found.", 'errors' => ""],
			        404
			       );
    	}
    }

    public function index()
    {
        return response()->json(
        	Game::paginate(10),
        	200
        );
    }

    public function store(GameRequest $request)
    {
    	try {
    		DB::beginTransaction();
    		$game = Game::create([
	    		'name' => $request->name,
	    		'release_at' => $request->release_at,
	    	]);

    		$game->genres()->attach($request->genres);

	    	DB::commit();
	    	if ($game) {
	    		return response()->json(
			        ['message' => "Game stored (key: ". $game->id .")!"],
			        200
		       	);
	    	}
    	} catch (Exception $e) {
    		DB::rollBack();
    		return response()->json(
		        ['message' => "Cannot create game!", 'errors' => $e->getMessage()],
		        404
	       	);
    	}
    	
    }

    public function update(GameRequest $request, $game_id)
    {
        $game = Game::find($game_id);
    	
		try {
			if ($game) {
				DB::beginTransaction();
				$game->update([
		    		'name' => $request->name,
		    		'release_at' => $request->release_at,
		    	]);

		    	$game->genres()->sync($request->genres);
		    	DB::commit();
    			return response()->json(
			        ['message' => "Game updated (key: ". $game->id .")!"],
			        200
			       );
    		}else{
    			throw new Exception("Game not found.", 1);
    		}
		} catch (Exception $e) {
			DB::rollBack();
			return response()->json(
		        ['message' => "Cannot update game (key: ". $game->id .")!", 'errors' => $e->getMessage()],
		        404
	       	);
		}
    		
    }

    public function destroy(Request $request, $game_id)
    {
        $game = Game::find($game_id);
    	
		try {
			if ($game) {
				DB::beginTransaction();
				$game->genres()->detach();
				$game->delete();
				DB::commit();
    			return response()->json(
			        ['message' => "Game deleted (key: ". $game_id .")!"],
			        200
			       );
    		}else{
    			throw new Exception("Game not found.", 1);
    		}
		} catch (Exception $e) {
			DB::rollBack();
			return response()->json(
		        ['errors' => $e->getMessage()],
		        404
	       	);
		}
    }
}
