<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeveloperController;



Route::get('/', [DeveloperController::class, 'showUploadForm']);
Route::post('/upload-birthdays', [DeveloperController::class, 'uploadBirthdays']);
Route::get('/cake-days', [DeveloperController::class, 'getCakeDays']);
Route::get('/cakes', [DeveloperController::class, 'showCakes']);


