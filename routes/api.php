<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
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
Route::middleware('auth:api')->get('/categorias', [CategoriaController::class, "index"]);
Route::middleware('auth:api')->get('/categorias/{id}', [CategoriaController::class, "show"]);
Route::middleware('auth:api')->get('/categorias/{id}/videos', [CategoriaController::class, "videos"]);
Route::middleware('auth:api')->post('/categorias', [CategoriaController::class, "store"]);
Route::middleware('auth:api')->put('/categorias/{id}', [CategoriaController::class, "update"]);
Route::middleware('auth:api')->delete('/categorias/{id}', [CategoriaController::class, "destroy"]);

Route::middleware('auth:api')->get('/videos', [VideoController::class, "index"]);
Route::middleware('auth:api')->get('/videos/{id}', [VideoController::class, "show"]);
Route::middleware('auth:api')->post('/videos', [VideoController::class, "store"]);
Route::middleware('auth:api')->put('/videos/{id}', [VideoController::class, "update"]);
Route::middleware('auth:api')->delete('/videos/{id}', [VideoController::class, "destroy"]);

Route::middleware('auth:api')->post('/usuarios', [UserController::class, "store"]);
Route::middleware('auth:api')->put('/usuarios/alterar-senha/{id}', [UserController::class, "updatePassword"]);
Route::middleware('auth:api')->put('/usuarios/alterar-token/{id}/', [UserController::class, "updateToken"]);
Route::middleware('auth:api')->put('/usuarios/{id}', [UserController::class, "update"]);
Route::middleware('auth:api')->delete('/usuarios/{id}', [UserController::class, "destroy"]);


/*
Route::middleware('auth:api')->middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
