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

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Class
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
