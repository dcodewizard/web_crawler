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

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMDocument;
use DOMXPath;
use App\Models\Link;
use Illuminate\Support\Str;

/**
 * Class
 *
 * @category Controller
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 * @license  https://laravel.com/ MIT
 * @link     https://laravel.com/
 */

class CrawlHomepageLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:homepage-links {inputString}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl homepage links';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $sitemapFilePath = public_path('sitemap.html');
            if (file_exists($sitemapFilePath)) {
                unlink($sitemapFilePath);
            }
            $inputString = $this->argument('inputString');
            Link::truncate();
            $url = $inputString;
            $html = file_get_contents($url);
            if ($html === false) {
                throw new \Exception('Failed to fetch HTML content.');
            }
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_use_internal_errors(false);
            $xpath = new DOMXPath($dom);
            $anchorTags = $xpath->query('//a');
            $result = [];
            $homePageDomain = parse_url($url, PHP_URL_HOST);
            $parts = explode('.', $homePageDomain);
            $domain = $parts[count($parts) - 2];
            $sitemapFile = fopen($sitemapFilePath, 'w');
            if (!$sitemapFile) {
                throw new \Exception('Failed to open sitemap file for writing.');
            }
            if ($sitemapFile) {
                foreach ($anchorTags as $anchor) {
                    $href = $anchor->getAttribute('href');
                    if ($href) {
                        if (parse_url($href, PHP_URL_HOST) === $homePageDomain 
                            || Str::contains($href, $domain)
                        ) {
                            fwrite($sitemapFile, " $href \n");
                            $link = new Link();
                            $link->url = $href;
                            $link->save();
                            $result[] = $href;
                        }
                    }
                }
                fclose($sitemapFile);
            }
            return ['result' => $result, 'error' => null];
        } catch (\Exception $e) {
            return ['result' => null, 'error' => $e->getMessage()];
        }
    }
}
