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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/authenticate', 'AuthController@authenticate');

Route::middleware('auth:api')->post('/resume','ResumeResourceApiController@store');
Route::middleware('auth:api')->get('/resume','ResumeResourceApiController@show');
Route::middleware('auth:api')->put('/resume','ResumeResourceApiController@update');
Route::middleware('auth:api')->delete('/resume','ResumeResourceApiController@destroy');

Route::middleware('auth:api')->post('/admin','AdminResourceApiController@store');
Route::middleware('auth:api')->get('/admin','AdminResourceApiController@show');
Route::middleware('auth:api')->delete('/admin','AdminResourceApiController@destroy');

Route::middleware('auth:api')->post('/applicant','ApplicantResourceApiController@store');
Route::middleware('auth:api')->get('/applicant','ApplicantResourceApiController@show');
Route::middleware('auth:api')->put('/applicant','ApplicantResourceApiController@update');
Route::middleware('auth:api')->delete('/applicant','ApplicantResourceApiController@destroy');

Route::middleware('auth:api')->post('/account', 'AccountResourceApiController@store');
Route::middleware('auth:api')->get('/account/{id}','AccountResourceApiController@show');
Route::middleware('auth:api')->put('/account','AccountResourceApiController@update');
Route::middleware('auth:api')->delete('/account','AccountResourceApiController@destroy');

Route::middleware('auth:api')->post('/user/account','UserResourceApiController@account');
Route::middleware('auth:api')->get('/user/{id}','UserResourceApiController@show');
Route::middleware('auth:api')->get('/user','UserResourceApiController@index');
Route::middleware('auth:api')->put('/user','UserResourceApiController@update');
Route::middleware('auth:api')->post('/user','UserResourceApiController@store');
Route::middleware('auth:api')->delete('/user','UserResourceApiController@destroy');
