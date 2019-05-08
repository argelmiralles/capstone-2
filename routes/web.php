<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Good
Route::get('/', function () {
    return view('welcome');
});

Route::get('/game-list', 'GameController@showGames');
Route::get('/view-details/{id}', 'GameController@showDetails');
Route::get('/game-list/category/{id}', "CategoryController@getGames");
Route::get('/search', 'GameController@search')->name('search');

Route::middleware("admin")->group(function(){
Route::get('/add-games','GameController@showAddGameForm');
Route::post('/games','GameController@addGame');
Route::get('/edit-games/{id}','GameController@showEditGameForm');
Route::patch('/edit/{id}','GameController@editGame');
Route::delete('/delete-game/{id}', 'GameController@deleteGame');
Route::get('/all_requests', 'RequestController@showAllRequests');
Route::post('/approval/{id}', 'RequestController@approval');
Route::post('/disapproval/{id}', 'RequestController@disapproval');
});

Route::middleware("user")->group(function(){
Route::post('/add-to-basket/{id}', 'GameController@addToBasket');
Route::get('/basket', "GameController@showBasket");
Route::get('/basket/clearBasket', 'GameController@clearBasket');
Route::get('/basket/{id}/delete', 'GameController@deleteFromBasket');
Route::patch('/basket/{id}/editQty', 'Gamecontroller@editQty');
Route::patch('/basket/{id}/editWeek', 'Gamecontroller@editWeek');
Route::get('/sendRequest', "GameController@sendRequest");
Route::get("/rent_requests", "RequestController@showRequests");
Route::get("/edit-profile", "GameController@edit");

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
