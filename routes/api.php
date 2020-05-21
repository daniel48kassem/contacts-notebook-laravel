<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user',function (Request $request){
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

Route::middleware('auth:api')->get('/contacts', 'ContactsController@getContacts');

Route::middleware('auth:api')->post('/contactSearch', 'ContactsController@contactSearch');
Route::middleware('auth:api')->post('/numbers/add', 'ContactsController@postNumber');
Route::middleware('auth:api')->post('/contacts', 'ContactsController@postContact');
Route::middleware('auth:api')->patch('/contacts/edit/{contact}', 'ContactsController@editContact');
Route::middleware('auth:api')->delete('/contacts/delete/{contact}', 'ContactsController@deleteContact');

Route::middleware('auth:api')->get('/numbers/{contact}', 'ContactsController@getNumbers');
Route::middleware('auth:api')->patch('/numbers/edit/{number}', 'ContactsController@editNumber');

Route::post('/todos', 'TodosController@store');
Route::patch('/todos/{todo}', 'TodosController@update');
Route::patch('/todosCheckAll', 'TodosController@updateAll');
Route::delete('/todos/{todo}', 'TodosController@destroy');
Route::delete('/todosDeleteCompleted', 'TodosController@destroyCompleted');




