<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Game;
use Session;
use \App\RentRequest;
use Auth;


class GameController extends Controller
{

   // CREATE 
   public function showAddGameForm(){
      return view("games.add_games");
   }

   public function addGame(Request $request){
      // $rules = array(
      //    "name" => "required",
      //    "description" => "required",
      //    "price" => "required|numeric",
      //    "image" => "required|image|mimes:jpeg,png,jpg,svh|max:2048",
      //    "category_id" => "required",
      //    "published_by" => 'required',
      //    "developed_by" => 'required',
      //    "quantityTotal" => 'required|numeric',
      //    "releaseYear" => 'required',
      //    "review" => 'required|numeric',
      //    "trailer_link" => 'required',
      //    "subtitle" => '',
      // );

      // $this->validate($request, $rules);

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
      $new_game->subtitle = $request->subtitle;
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

//  SEARCH
  public function search(Request $request){
      
      $request->validate([
         'search' => 'required|min:3',
      ]);

      $search = $request->input('search');
      $games = Game::where('name', 'like', "%$search%")->get();

      return view('games.search-results', compact('games'));
  }

   // ADD TO BASKET
   public function addToBasket(Request $request, $id){
      $game = Game::find($id);
      if(Session::has("basket")){
         // Check if user has an exisiting request
         Session::flash("basket_full", "You may only rent one game at a time. Click on the Basket if you wish to change the game you want to rent");
          return redirect('/basket');
      }else {
          $basket =[];
      }
         $basket[$id] = ['week'=>$request->week];
         

  
      Session::put("basket", $basket);
      Session::flash("success_basket", "$game->name added to basket");
      return redirect("/basket");
  }

   //   SHOW BASKET

   public function showBasket(){

      $basket_with_details = []; // will contain item's name, price and other details
        $total = 0;
        if(Session::has("basket")){
            $basket_without_details = Session::get("basket"); // only contains item's id and quantity
            
            foreach($basket_without_details as $id => $details){
                $game = Game::find($id);
                $game->quantity = 1;
                $game->week = $details['week'];
                $game->subtotal = $game->price * $details['week'] * $game->quantity;
                // At this point, each element of $item has id, name, price, description, img_path, category_id AND quantity, subtotal.
                // We added the quantity and subtotal properties to $item BUT the DO NOT EXIST in the database

                $total += $game->subtotal;
                $basket_with_details[] = $game;
                // we add to cart_with_details the entry for the current item
            }
        }
        // dd($cart_with_details);
        return view("games.basket", compact("basket_with_details", "total"));

   }

   // CLEAR BASKET
   public function clearBasket(){
      Session::forget("basket");
      return redirect("/game-list");
  }

//   Delete from basket
   public function deleteFromBasket($id){
      Session::forget("basket.$id");
      return redirect("/basket");
   }
   // EDIT BASKET

  public function editWeek(Request $request, $id){
   $basket = Session::get("basket");
   $basket[$id]['week'] = $request->week;
   Session::put("basket", $basket);
   return redirect("/basket");
}

   public function sendRequest(){
      $request = new RentRequest;
      $request->user_id = Auth::user()->id;
      $request->total = 0;
      $request->status_id = 1;
      $request->save();

      $total = 0;
      foreach(Session::get("basket") as $game_id => $details){

         $quantity = 1;
         $week = $details['week'];
         $request->games()->attach($game_id, ['quantity'=>$quantity, 'week'=>$week]);
         $game = Game::find($game_id);
         $total += $game->price * $quantity * $details['week'];    
      }
         $request->total = $total;
         $request->save();
         Session::forget("basket");
         return redirect("/home");
      }

      public function edit(){
         return view('games.edit-profiles');
      }
   
   
}
