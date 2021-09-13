<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user/get/{$id}', [UserController::class, 'getUser']);
Route::post('user/create', [UserController::class, 'createUser']);
Route::post('user/update/{$id}', [UserController::class, 'updateUser']);
Route::delete('user/delete/{$id}', [UserController::class, 'deleteUser']);

Route::get('phone/get/{id}', [PhoneController::class, 'readPhone']);
Route::post('phone/create', [PhoneController::class, 'createPhone']);
Route::post('phone/update/{id}', [PhoneController::class, 'updatePhone']);
Route::delete('phone/delete/{id}', [PhoneController::class, 'deletePhone']);

