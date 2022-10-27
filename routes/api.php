<?php

use App\Http\Controllers\VideoController;
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

Route::get('/videos', [VideoController::class, "index"]);
Route::get('/videos/{id}', [VideoController::class, "show"]);
Route::post('/videos', [VideoController::class, "store"]);
Route::put('/videos/{id}', [VideoController::class, "update"]);
Route::delete('/videos/{id}', [VideoController::class, "destroy"]);

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
