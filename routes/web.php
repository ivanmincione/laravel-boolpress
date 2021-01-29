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

Route::get('/', "HomeController@index")->name("index");
Route::get("/contacts","HomeController@contacts")->name("contacts");
Route::get("/about","HomeController@about")->name("about");
Route::get("/posts","PostController@index")->name("posts.index");
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');

Route::get('/categories/{slug}', 'CategoryController@show')->name('categories.show');


Auth::routes(["register" => false]); //disabilito la rotta di registrazione al sito


//middleware da inserire su tutte le rotto da tutelare
Route::prefix("admin")->namespace("Admin")->middleware('auth')->name('admin.')->group( function() {

//tutte le rotte all'interno di questo gruppo inizieranno con admin/
    Route::get('/', 'HomeController@index')->name('index');

    //gestisco le rotte delle CRUD sempre all'interno del gruppo di rotte riguardanti l'admin
    Route::resource("/posts", "PostController");



});
