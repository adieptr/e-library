<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->group(function(){
    Route::post("/apiTest", [UserController::class, 'store']);
    Route::post("/apiTest/login", [UserController::class, 'login']);
    Route::get("/apiTest/profile/{id}", [UserController::class, 'showProfile']);
    Route::post("/apiTest/profile/update/{id}", [UserController::class, 'update']);
    Route::post("/apiTest/updatePassword/{id}", [UserController::class, 'updatePassword']);
    Route::post("/apiTest/updatePasswordByEmail", [UserController::class, 'updatePasswordByEmail']);
});

Route::controller(CourceController::class)->group(function(){
    Route::get("/apiCource","index");
    Route::get("/apiCource/{id}","detailsCource");
    Route::get("/search/cource","searchCource");
    Route::post("/apiCource/materi","materiContent");
    Route::post("/apiClass","detailKelas");
});
Route::controller(ClassController::class)->group(function(){
    Route::get("/apiKelas/{id}","index");
});
