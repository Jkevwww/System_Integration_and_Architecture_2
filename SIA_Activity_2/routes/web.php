<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MythologyController;

Route::get('/', [MythologyController::class, 'index'])->name('mythology.index');
Route::get('/creature/{id}', [MythologyController::class, 'show'])->name('mythology.show');
