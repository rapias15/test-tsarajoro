<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route pour les api de l'utilisateur
 */

// WebService pour lister les utilisateurs éxistants dans la base de données
Route::get('user/list', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('user.list');
// WebService pour enregistrer un nouveau utilisateur
Route::get('user/create', [UserController::class, 'storeUser'])
    ->middleware(['auth'])
    ->name('user.create');
// WebService pour afficher un utilisateur
Route::get('user/{user}', [UserController::class, 'show'])
    ->middleware(['auth'])
    ->name('user.show');
// WebService pour editer un utilisateur
Route::post('user/{user}/edit', [UserController::class, 'update'])
    ->middleware(['auth'])
    ->name('user.update');
Route::delete('user/{user}/delete', [UserController::class, 'delete'])
    ->middleware(['auth'])
    ->name('user.delete');
