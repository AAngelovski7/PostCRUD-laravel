<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/about',function(){
    return view('pages.about');
});

//{id} is put to the function and will be returned on page This is user 22(for users/22)
//this is passing dynamic value
Route::get('users/{id}',function($id){
    return 'This is user'.$id;
});  

//Get on /, /about and /services call index(),about(),services() function from Pages controler 
Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::resource('posts','PostController');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');


