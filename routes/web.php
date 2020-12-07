<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarCsvController;


Route::get('/' , [CalendarCsvController::class,'index']);
Route::get('/exportCsv' , [CalendarCsvController::class,'exportCsv']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
