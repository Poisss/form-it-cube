<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return  redirect()->route('index');
});
Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/admin')->group(function(){
        Route::get('/form',[FormController::class,'index'])->name('index');
        Route::get('/form/{form}',[FormController::class,'show'])->name('show');
        // Route::resource('/form',FormController::class)->except('index');
    })->middleware('checkRole:admin');

});

Route::get('/signin',[UserController::class,'signin'])->name('signin');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::get('/signup',[UserController::class,'create'])->name('signup');
Route::post('/logup',[UserController::class,'store'])->name('logup');

Route::get('/form/{form}',[FormController::class,'showform'])->name('showform');
Route::post('/form',[FormController::class,'questionnaire'])->name('questionnaire');
Route::get('/form/{form}/success',[FormController::class,'successform'])->name('successform');

