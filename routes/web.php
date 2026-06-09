<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/pengaturan', 'pengaturan');
Route::view('/eksplor', 'eksplor');
Route::view('/disimpan', 'disimpan');
Route::view('/leaderboard', 'leaderboard');