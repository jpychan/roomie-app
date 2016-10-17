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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/groups', 'GroupController@index')->name('groups');
Route::get('/group/{group}', 'GroupController@show')->name('group');
Route::get('/group/{group}/expenses/new', 'ExpenseController@new')->name('newExpense');
Route::post('/expenses/create', 'ExpenseController@create');
Route::post('/group', 'GroupController@store');
Route::post('/group/{group}', 'GroupController@edit');
Route::delete('/group/{group}', 'GroupController@destroy');
// Route::get('/expenses/new', 'ExpenseController@new');
Route::post('/expenses/create', 'ExpenseController@create');
Route::post('/group/{group}/removeMember', 'GroupController@removeMember');
Route::post('/group/{group}/addMember', 'GroupController@addMember');
