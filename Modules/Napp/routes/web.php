<?php

use Illuminate\Support\Facades\Route;
use Modules\Napp\Http\Controllers\Napp\BirthDateController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('napps', BirthDateController::class)->names('napp');
});
