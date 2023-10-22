<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\Link;

class HomeController extends Controller
{
    public function getHomepageLinks(Request $request)
    {
        $inputString = $request->input('inputString');
        Artisan::call('crawl:homepage-links', ['inputString' => $inputString]);
        $links = Link::pluck('url')->all();
        $homePageDomain = parse_url($inputString, PHP_URL_HOST);
        $parts = explode('.', $homePageDomain);
        $domain_name = $parts[count($parts) - 2];
        return view('homepage', ['links' => $links, 'homePageDomain' => $homePageDomain, 'domain_name' => $domain_name]);
    }
}
