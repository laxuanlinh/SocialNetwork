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

Route::get('/', [
    'uses'=> '\Link\Http\Controllers\HomeController@index',
    'as' => 'home'
]);
/**
 *  Authentication
 */
Route::get('/signup', [
    'uses' => '\Link\Http\Controllers\AuthController@getSignUp',
    'as' => 'auth.signup',
    'middleware' => ['guest']
]);
Route::post('/signup', [
   'uses'=>  '\Link\Http\Controllers\AuthController@postSignUp',
    'middleware' => ['guest']
]);
Route::get('/signin', [
    'uses'=> '\Link\Http\Controllers\AuthController@getSignIn',
    'as' => 'auth.signin',
    'middleware' => ['guest']
]);
Route::post('/signin', [
    'uses'=> '\Link\Http\Controllers\AuthController@postSignIn',
    'middleware' => ['guest']
]);
Route::get('/signout', [
   'uses'=> '\Link\Http\Controllers\AuthController@getSignOut',
    'middleware' => ['auth']
]);

/**
 * Search
 */
Route::get('/search', [
    'uses' => '\Link\Http\Controllers\SearchController@getResults',
    'middleware' => ['auth'],
    'as' => 'search.results'
]);

/**
 * User profile
 */

Route::get('/profile/edit', [
    'uses' => '\Link\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth']
]);

Route::post('profile/edit', [
    'uses' => '\Link\Http\Controllers\ProfileController@postEdit',
    'middleware' => ['auth']
]);


Route::get('profile/{username}',[
    'uses' => '\Link\Http\Controllers\ProfileController@getProfile',
    'middleware' => ['auth'],
    'as' => 'profile'
]);

/**
 * Friends
 */
Route::get('/friends',[
    'uses' => '\Link\Http\Controllers\FriendController@getIndexPage',
    'middleware' => ['auth'],
    'as' => 'friends'
]);

Route::get('/friend/add/{username} ',[
    'uses'=>'\Link\Http\Controllers\FriendController@getAdd',
    'middleware'=>['auth'],
    'as' => 'addfriend'
]);

Route::get('/friend/accept/{username}',[
    'uses'=>'\Link\Http\Controllers\FriendController@getAccept',
    'middleware'=>['auth'],
    'as'=>'acceptfriend'
]);

Route::post('/friend/delete/{username}',[
    'uses'=>'\Link\Http\Controllers\FriendController@postDelete',
    'middleware'=>['auth'],
    'as'=>'deletefriend'
]);

/**
 * Statuses
 */
Route::post('status', [
    'uses'=>'\Link\Http\Controllers\StatusController@postStatus',
    'middleware'=>['auth'],
    'as'=>'status.post'
]);

Route::post('status/{statusId}/reply', [
    'uses'=>'\Link\Http\Controllers\StatusController@postReply',
    'middleware'=>['auth'],
    'as'=>'status.reply'
]);

Route::get('status/{statusId}/like', [
    'uses'=>'\Link\Http\Controllers\StatusController@getLike',
    'middleware'=>['auth'],
    'as'=>'status.like'
]);

Route::get('status/{statusId}/dislike', [
    'uses'=>'\Link\Http\Controllers\StatusController@getDislike',
    'middleware'=>['auth'],
    'as'=>'status.dislike'
]);