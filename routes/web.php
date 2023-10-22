<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;

Route::get(
    '/', function () {
        return view('dashboard');
    }
)->middleware(['auth'])->name('dashboard');


Route::post('get-homepage-links', [HomeController::class, 'getHomepageLinks']);

// Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');
Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';
