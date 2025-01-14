<?php

use Illuminate\Support\Facades\Route;
Route::middleware('throttle:api')->group(function () {
    Route::get('/set-menus', [\App\Http\Controllers\SetMenuController::class, 'index']);
    Route::get('/cuisines', [\App\Http\Controllers\CuisineController::class, 'index']);
});

