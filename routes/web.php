<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('set/locale/{locale}', [SiteController::class, 'locale'])
    ->whereIn('locale', array_keys(config('app.locales')))
    ->name('set.locale');
