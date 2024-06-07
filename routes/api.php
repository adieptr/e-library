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
    Route::post("/apiTest","store");
    Route::post("/apiTest/login",'login');
    Route::get("/apiTest/profile/{id}","showProfile");
    Route::post("/apiTest/profile/update/{id}","update");
    Route::post("/apiTest/updatePassword/{id}","updatePassword");
});
Route::controller(CourceController::class)->group(function(){
    Route::get("/apiCource","index");
    Route::get("/apiCource/{id}","detailsCource");
    Route::get("/search/cource","searchCource");
});
Route::controller(ClassController::class)->group(function(){
    Route::get("/apiKelas/{id}","index");
});
