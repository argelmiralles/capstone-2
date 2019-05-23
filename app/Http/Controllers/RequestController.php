<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RentRequest;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Game;
use Session;

class RequestController extends Controller
{
    public function showRequests(){
    	$requests = RentRequest::where("rent_requests.user_id", Auth::user()->id)->get();
    	return view("games.request_details", compact("requests"));
    }
    public function showAllRequests(){
        $requests = RentRequest::all();
        $dateNow = Carbon::now();
        $overdueRents = RentRequest::where('rent_requests.rent_end_date',"<", $dateNow)->get();
        return view("games.all_requests", compact("requests"));
        
    }

    public function approval(Request $request, $id){
        
        $game = Game::find($request->game);
        if($game->quantityInStock > 0){
        $game->quantityInStock --;
        $game->quantityOnRent++;
        $game->save();
        
        $rent_request = RentRequest::find($id);
        $rent_request->status_id = 2;
        $rent_request->on_rent = true;
        $rent_request->rent_start_date = Carbon::now();
        $rent_request->rent_end_date = Carbon::now()->addDays(7*$request->week);
        $rent_request->save();
        
        return redirect("/all_requests");
        } else {
            Session::flash("out_of_stock", "$game->name is out of stock");
            return redirect("/all_requests");
        }
    }

    public function disapproval($id){
        $rent_request = RentRequest::find($id);
        $rent_request->status_id = 3;
        $rent_request->save();
        return redirect("/all_requests");
    }

    public function cancelRequest($id){
        $rent_request = RentRequest::find($id);
        $rent_request->status_id = 4;
        $rent_request->save();
        return redirect("/rent_requests");
    }

    public function returned(Request $request, $id){
         $rent_request = RentRequest::find($id);
        $rent_request->status_id = 6;
        $rent_request->on_rent = false;
        $rent_request->save();

         $game = Game::find($request->game);
         $game->quantityInStock ++;
        $game->quantityOnRent--;
        $game->save();
        return redirect("/all_requests");
    }

    public function checkOverdue(){
       
    }
}
