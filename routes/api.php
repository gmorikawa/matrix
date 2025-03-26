<?php

use App\Http\Controllers\RepositoryController;
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

Route::get("/users/{owner_id}/repositories", [RepositoryController::class, "getByOwner"]);
Route::get("/users/{owner_id}/repositories/project/{project_id}", [RepositoryController::class, "getByProject"]);
Route::get("/users/{owner_id}/repositories/{id}", [RepositoryController::class, "getById"]);
Route::post("/users/{owner_id}/repositories", [RepositoryController::class, "insert"]);
Route::patch("/users/{owner_id}/repositories/{id}", [RepositoryController::class, "update"]);
Route::delete("/users/{owner_id}/repositories/{id}", [RepositoryController::class, "remove"]);

Route::get("/users/{owner_id}/projects", [RepositoryController::class, "getByOwner"]);
Route::get("/users/{owner_id}/projects/{id}/repositories", [RepositoryController::class, "getRepositories"]);
Route::get("/users/{owner_id}/projects/{id}", [RepositoryController::class, "getById"]);
Route::post("/users/{owner_id}/projects", [RepositoryController::class, "insert"]);
Route::patch("/users/{owner_id}/projects/{id}", [RepositoryController::class, "update"]);
Route::delete("/users/{owner_id}/projects/{id}", [RepositoryController::class, "remove"]);
