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
    return view('welcomehere');
});

Auth::routes();

Route::get('/admin', 'AdminHomeController@index')->name('admin');
Route::get('/user', 'UserHomeController@index')->name('user'); 

Route::get('/user/register', 'UserRegController@index')->name('user.register');
Route::post('/user/register', 'UserRegController@store');

Route::get('/reg','RegistrationController@index')->name('registration');
Route::post('/reg', 'RegistrationController@store')->name('reg.store');
Route::post('/reg/fetch','RegistrationController@fetch')->name('reg.fetch');

Route::get('/user/vote', 'UserVoteController@index')->name('user.vote');
Route::post('/user/vote','UserVoteController@store')->name('vote.store');
Route::post('/user/vote/fetch','UserVoteController@fetch')->name('candidate.fetch');
Route::get('/user/results', 'UserHomeController@results')->name('user.results');

Route::resource('admin/users','AdminUserController');
Route::post('admin/users/fetch','AdminUserController@fetch')->name('dept.fetch');

Route::resource('/admin/candidates','AdminCandidateController');
Route::resource('/admin/office','AdminOfficeController');
Route::resource('/admin/setup','AdminSetupController');
Route::resource('/admin/votes','AdminVotesController');
Route::post('/admin/votes', 'AdminVotesController@store')->name("votes.store");

// Route::get('users', 'UsersController@index')->name('index');
// Route::get('users/create', 'UsersController@create')->name('create');
// Route::post('users', 'UsersController@store')->name('store');
// Route::get('users/{user}', 'UsersController@show')->name('show');