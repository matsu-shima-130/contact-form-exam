<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::get('/',[ContactController::class,'index']);
Route::post('/confirm',[ContactController::class,'confirm']);
Route::get('/thanks',[ContactController::class,'thanks']);
Route::get('/admin',[ContactController::class,'admin']);
Route::get('/register',[ContactController::class,'register']);
Route::get('/login',[ContactController::class,'login']);