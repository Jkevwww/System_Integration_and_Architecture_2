<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;

Route::get('/', function () {
    return redirect()->route('tools.index');
});

Route::resource('tools', ToolController::class);
