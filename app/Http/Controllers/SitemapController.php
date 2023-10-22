<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * php version 7.2
 *
 * @category Web_Framework
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

class SitemapController extends Controller
{
    /**
     * Display the "index" page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sitemapFilePath = public_path('sitemap.html');
        if (!file_exists($sitemapFilePath)) {
            return response()->json(['error' => 'Sitemap file not found'], 404);
        }
        try {
            return response()->file($sitemapFilePath);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Error while returning the sitemap file'], 500
            );
        }
    }
}