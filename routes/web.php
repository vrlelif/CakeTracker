<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\Controller;
Route::post('/upload-birthdays', [DeveloperController::class, 'uploadBirthdays']);
Route::get('/cake-days', [DeveloperController::class, 'getCakeDays']);
