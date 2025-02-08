<?php

use App\Http\Controllers\OccupationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OccupationController::class, 'index']);

Route::get('/get-jobs/{date}', [OccupationController::class, 'getJobs']);
