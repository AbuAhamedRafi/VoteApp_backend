<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('categories', CategoryController::class);

Route::apiResource('categories.options', OptionsController::class)->scoped([
    'option' => 'id'
]);

Route::apiResource('votes', VoteController::class)->only(['store', 'index','update']);