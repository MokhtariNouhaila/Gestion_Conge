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

Route::resource('conges','CongeController');
Route::get('conges/{id}/valider', 'CongeController@valider');
Route::get('conges/{id}/rejeter', 'CongeController@rejeter');
Route::get('generer', 'UserController@generer');

Route::get('conges/{etat}/etat', 'CongeController@etat');
Route::get('dash', 'UserController@countUser');
/** */
 
Route::get('conges/{id}/dynamic_pdf/pdf', 'DynamicPDFController@pdf');
/** */
/* 
Route::get('users', 'UserController@index');
Route::get('users/create', 'UserController@create');
Route::post('users', 'UserController@store');
Route::get('users/{id}/edit', 'UserController@edit');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@destroy');
 */
Route::resource('users','UserController');
/* */
Route::get('/', function () {
    return view('auth/login');
});
Route::get('notif', function () {
    return view('conge/notif');
});

 
Route::get('e', function () {
    return view('conge/exp');
});

 
/* */
 
Route::get('profil', function(){
    return view('conge/profil');
});

 
/* */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
