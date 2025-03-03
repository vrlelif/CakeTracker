<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\Controller;



Route::get('/uploadForm', [DeveloperController::class, 'showUploadForm']);
Route::post('/upload-birthdays', [DeveloperController::class, 'uploadBirthdays']);
Route::get('/cake-days', [DeveloperController::class, 'getCakeDays']);
