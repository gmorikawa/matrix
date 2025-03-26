<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});//->middleware('auth:sanctum');

Route::get("/users", [UserController::class, "getAll"]);
Route::get("/users/{id}", [UserController::class, "getById"]);
Route::post("/users", [UserController::class, "insert"]);
Route::patch("/users/{id}", [UserController::class, "update"]);
Route::delete("/users/{id}", [UserController::class, "remove"]);
