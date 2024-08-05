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
    Route::get('/', 'TemplateController@index');
    Route::post('/storeUserTemp', 'TemplateController@storeUserTemp');
    Route::post('/storeAdminTemp', 'TemplateController@storeAdminTemp');
    Route::post('/saveExit', 'TemplateController@saveExit');
    Route::put('/updateTemp/{id}', 'TemplateController@update');
    Route::delete('/{id}', 'TemplateController@destroy');
    Route::get('/getFonts', 'TemplateController@getFonts');
    
    Route::post('/uploadImage', 'TemplateController@uploadImage');
    Route::get('/loadUserImages/{id}', 'TemplateController@loadUserImages');
    Route::get('/getImage/{id}', 'TemplateController@getImage');
    Route::get('/showTemp/{product_id}/{user_id}', 'TemplateController@showTemp');
    
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
