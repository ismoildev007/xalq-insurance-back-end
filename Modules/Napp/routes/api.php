<?php

use Illuminate\Support\Facades\Route;
use Modules\Napp\Http\Controllers\Napp\BirthDateController;
use Modules\Napp\Http\Controllers\Napp\ConfirmPayedController;
use Modules\Napp\Http\Controllers\Napp\ContractAddController;

//Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//    Route::apiResource('napps', NappController::class)->names('napp');
//});

Route::prefix('napp/ersp')->group(function () {
    Route::post('/birth-date', [BirthDateController::class, 'erspBirthDate']);
    Route::post('/contract-add', [ContractAddController::class, 'contractAdd']);
    Route::post('/confirm-payed', [ConfirmPayedController::class, 'confirmPayed']);
});
