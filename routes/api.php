<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VideoController;
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
Route::get('/categorias', [CategoriaController::class, "index"]);
Route::get('/categorias/{id}', [CategoriaController::class, "show"]);
Route::get('/categorias/{id}/videos', [CategoriaController::class, "videos"]);
Route::post('/categorias', [CategoriaController::class, "store"]);
Route::put('/categorias/{id}', [CategoriaController::class, "update"]);
Route::delete('/categorias/{id}', [CategoriaController::class, "destroy"]);

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
