<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function getGames($id){
    	$category = Category::find($id);
    	$games = $category->game;
    	return view("games.game-list", compact("games"));
    }
}
