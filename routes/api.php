<?php

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
    Route::prefix('contact')->group(function() {
        Route::get('/', [ContactController::class, 'index']);
        Route::post('/new', [ContactController::class, 'store']);
        Route::get('{id}', [ContactController::class, 'show']);
        Route::put('edit/{id}', [ContactController::class, 'update']);
        Route::delete('delete/{id}', [ContactController::class, 'destroy']);
    });

    Route::prefix('additional-contact')->group(function() {
        Route::delete('delete/{id}', [AdditionalContactController::class, 'destroy']);
    });
});



