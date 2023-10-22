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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\Link;
use Illuminate\Database\QueryException;

/**
 * Class
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

class HomeController extends Controller
{
    /**
     * Create a new command instance.
     * 
     * @param \App\Http\Requests\Auth\LoginRequest $request comment
     *
     * @return void
     */
    public function getHomepageLinks(Request $request)
    {
        try {
            $inputString = $request->input('inputString');
            Artisan::call('crawl:homepage-links', ['inputString' => $inputString]);
            $output = Artisan::output();
            $result = json_decode($output, true);
            if (isset($result['error'])) {
                return view('homepage', ['error' => $result['error']]);
            }
            $links = Link::pluck('url')->all();
            $homePageDomain = parse_url($inputString, PHP_URL_HOST);
            $parts = explode('.', $homePageDomain);
            $domain_name = $parts[count($parts) - 2];
            return view(
                'homepage', 
                ['links' => $links, 'homePageDomain' => $homePageDomain,
                 'domain_name' => $domain_name, 'error' => null]
            );
        } catch (QueryException $e) {
            return view(
                'homepage', [ 'error' => 
                'Database error occurred. Please try again later.']
            );
        } catch (\Exception $e) {
            return view(
                'homepage', [ 'error' => 
                'An unexpected error occurred. Please try again later.']
            );
        }
    }
}
