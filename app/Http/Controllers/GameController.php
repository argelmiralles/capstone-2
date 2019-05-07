<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Game;
use Session;


class GameController extends Controller
{

   // CREATE 
   public function showAddGameForm(){
      return view("games.add_games");
   }

   public function addGame(Request $request){
      $rules = array(
         "name" => "required",
         "description" => "required",
         "price" => "required|numeric",
         "image" => "required|image|mimes:jpeg,png,jpg,svh|max:2048",
         "category_id" => "required",
         "published_by" => 'required',
         "developed_by" => 'required',
         "quantityTotal" => 'required|numeric',
         "releaseYear" => 'required',
         "review" => 'required|numeric'
      );

      $this->validate($request, $rules);

      $new_game = new Game;
      $new_game->name = $request->name;
      $new_game->description = $request->description;
      $new_game->price = $request->price;
      $image = $request->file('image');
      $image_name = time().".".$image->getClientOriginalExtension();
      $destination = "images/";
      $new_game->img_path = $destination.$image_name;
      $image->move($destination, $image_name);
      $new_game->category_id = $request->category_id;
      $new_game->published_by = $request->published_by;
      $new_game->developed_by = $request->developed_by ;
      $new_game->quantityTotal = $request->quantityTotal;
      $new_game->quantityInStock = $request->quantityTotal;
      $new_game->releaseYear = $request->releaseYear;
      $new_game->review = $request->review;
      $new_game->trailer_link = $request->trailer_link;
      $new_game->save();
      Session::flash("message", "New Game Added");
      return redirect('/game-list');


      $new_game->save();
   }

   // RETRIEVE

   public function showGames(){
      $games = Game::all();
      return view("games.game-list", compact('games'));
   }

   public function showDetails($id){
      $game = Game::find($id);
      return view("games.game-details", compact('game'));
   }

   // EDIT

   public function showEditGameForm($id){
      $game = Game::find($id);
      return view("games.edit-games", compact('game'));
   }

   public function editGame(Request $request, $id){
      $rules = array(
         "name" => "required",
         "description" => "required",
         "price" => "required|numeric",
         // "image" => "image|mimes:jpeg,png,jpg,svh|max:2048"
         // "category_id" => "required",
         // "published_by" => 'required',
         // "developed_by" => 'required',
         // "quantityTotal" => 'required|numeric',
         // "releaseYear" => 'required',
         // "review" => 'required|numeric'
      );
         $this->validate($request, $rules);

         $game = Game::find($id);
         $game->name = $request->name;
         $game->description = $request->description;
         $game->price = $request->price;
         if($request->file("image") != null){
            $image = $request->file("image");
            $image_name = time().".".$image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination, $image_name);
            $game->img_path = $destination.$image_name;
            };

         $game->category_id = $request->category_id;
         $game->published_by = $request->published_by;
         $game->developed_by = $request->developed_by ;
         $game->quantityTotal = $request->quantityTotal;
         $game->quantityInStock = $request->quantityTotal;
         $game->releaseYear = $request->releaseYear;
         $game->review = $request->review;
         $game->save();
         Session::flash("message"," edited");
         return redirect('/game-list');
   }

   // DELETE
   public function deleteGame($id){
      $game = Game::find($id);
      $game->delete();
      Session::flash("message", "Game Deleted");
      return redirect("/game-list");
  }
}
