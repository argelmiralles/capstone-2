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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/game-list', 'GameController@showGames');
Route::get('/view-details/{id}', 'GameController@showDetails');

Route::middleware("admin")->group(function(){
Route::get('/add-games','GameController@showAddGameForm');
Route::post('/games','GameController@addGame');
Route::get('/edit-games/{id}','GameController@showEditGameForm');
Route::patch('/edit/{id}','GameController@editGame');
Route::delete('/delete-game/{id}', 'GameController@deleteGame');
});

Route::middleware("user")->group(function(){


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
