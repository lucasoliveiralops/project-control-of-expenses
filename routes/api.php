<?php

use App\Http\Controllers\V1\Account\LoginController;
use App\Http\Controllers\V1\ExpensesController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->name('client.noSensitiveData')->group(function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::apiResource('expenses', ExpensesController::class);
    });
});

