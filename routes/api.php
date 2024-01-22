<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-config-cache', function () {
    $exitCode = Artisan::call('config:clear');
    return 'Config cache cleared'; // Return a response to confirm the action
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 
Route::prefix('template')->group(function () {
    Route::get('/', 'TemplateApiController@index');
    Route::post('/storeTemp', 'TemplateApiController@storeTemp');
    Route::post('/storePng', 'TemplateApiController@storePng');
    Route::get('/showTemp/{id}/{position}', 'TemplateApiController@show');
    Route::put('/updateTemp/{id}', 'TemplateApiController@update');
    Route::delete('/{id}', 'TemplateApiController@destroy');
    Route::get('/getFonts', 'TemplateApiController@getFonts');
    
    Route::post('/uploadImage', 'TemplateApiController@uploadImage');
    Route::get('/loadUserImages/{id}', 'TemplateApiController@loadUserImages');
    Route::get('/getImage/{id}', 'TemplateApiController@getImage');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
