<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->namespace('Api\V1')->group(function(){

    Route::get('/status', function(){
        return response()->json(['status'=> 'Ok']);
    })->name('status')->middleware('auth:api');

    Route::apiResource('post.comment', 'PostCommentController');


});

Route::fallback(function(){
    return response()->json([
        "message" => "Not found",
    ], 404);
})->name('api.fallback');