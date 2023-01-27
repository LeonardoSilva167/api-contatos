<?php

use App\Exceptions\Message;
use App\Http\Controllers\V1\AdditionalContactController;
use App\Http\Controllers\V1\ContactController;
use App\Http\Controllers\V1\UserContactController;
use App\Http\Controllers\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/',function(){
    return response()->json(['api_name' => 'loja-back-end', 'api_version' => '1.0.0']);
});

Route::prefix('v1')->group(function() {

    Route::prefix('contact')->controller(ContactController::class)->group(function() {        
        Route::get('/get-count-contacts','getCountContacts');
        Route::get('/','index');
        Route::post('/new','store');
        Route::get('{id}','show');
        Route::put('edit/{id}','update');
        Route::delete('delete/{id}','destroy');
        
    });
    
    Route::prefix('additional-contact')->controller(AdditionalContactController::class)->group(function() {
        Route::get('/','index');
        Route::post('/new','store');
        Route::get('{id}','show');
        Route::put('edit/{id}','update');
        Route::delete('delete/{id}','destroy');
    });

    
});

Route::fallback(function(){
    return response()->json(['error' => true,'data'=> null,'state' => Message::ERRO,'Página não encontrada.'], 404);
});


