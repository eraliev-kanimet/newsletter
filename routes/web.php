<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('set/locale/{locale}', [SiteController::class, 'locale'])->name('set.locale');

Route::get('/app', [PageController::class, 'app'])->name('app');
Route::get('app/{any}', [PageController::class, 'app'])->where('any', '.*');
