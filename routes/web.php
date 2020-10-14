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


  Route::get('/home', 'Guest\RegisterController@top');
  Route::get('/auth/logout', 'Guest\RegisterController@top');
  Route::get('/', 'Guest\RegisterController@top');
  Route::get('auth/register','Guest\RegisterController@register');
  Route::get('auth/login','Guest\RegisterController@login');
  Route::get('logout','Auth\LoginController@logout');
  Route::get('/favorite/{id}', 'FavoriteController@execute');
  Route::get('/editGallary/{id}', 'Admin\ProfileController@gallary_delete');
  Route::post('/updateGallary','Admin\ProfileController@gallaryUpdate');
  Route::post('/updateProfile','Admin\ProfileController@profileUpdate');



Route::group(['prefix' => 'admin'],function(){
   Route::get('profile/edit','Admin\ProfileController@edit')->middleware('auth');
   Route::post('profile/edit','Admin\ProfileController@update')->middleware('auth');
   Route::get('profile/info','Admin\ProfileController@info')->middleware('auth');
   Route::get('reserch/index','Admin\ProfileController@reserchindex')->middleware('auth');
   Route::post('reserch/index','Admin\ProfileController@reserchindex')->middleware('auth');
   Route::get('gallary/edit','Admin\ProfileController@gallary_edit')->middleware('auth');
   // Route::post('gallary/edit','Admin\ProfileController@gallary_update')->middleware('auth');
   Route::get('profile/otherinfo','Admin\ProfileController@otherinfo')->middleware('auth');
   Route::get('reserch/favoritelist','Admin\ProfileController@favoritelist')->middleware('auth');
   Route::get('massage/offer','Admin\ProfileController@offer')->middleware('auth');
   Route::post('massage/offer','Admin\ProfileController@sendoffer')->middleware('auth');
   Route::get('massage/offerindex','Admin\ProfileController@offerlist')->middleware('auth');
   Route::get('massage/offermessage','Admin\ProfileController@offermessage')->middleware('auth');
});



Auth::routes();
// Route::get('/', 'HomeController@index');
