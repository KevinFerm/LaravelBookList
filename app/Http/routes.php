<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

Route::auth();
Route::post('/search', 'HomeController@search');
Route::post('/add', 'HomeController@add');
Route::get('/mylist/{user_id}', 'HomeController@mylist')->name('mylist');
Route::get('/home', 'HomeController@index');
Route::get('/movies', 'HomeController@movies');
Route::resource('lists', 'ListController');
