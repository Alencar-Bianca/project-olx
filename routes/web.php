<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\{StateController, CategoryController, UserController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ping', function (): JsonResponse {
    return response()->json(['Pong' => true]);
});

Route::get('/states', [StateController::class,'index'])->name('states');
Route::get('/categories', [CategoryController::class,'index'])->name('states');


Route::post('/user/signup', [UserController::class,'signUp'])->name('user.signup');
Route::post('/user/signin', [UserController::class,'signIn'])->name('user.signin');
Route::get('user/me', [UserController::class,'signMe'])->name('user.me')->middleware('auth:sanctum');
