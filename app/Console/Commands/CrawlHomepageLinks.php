<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMDocument;
use DOMXPath;
use App\Models\Link;
use Illuminate\Support\Str;

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
        $inputString = $this->argument('inputString');
        Link::truncate();
        $url = $inputString;
        $html = file_get_contents($url);
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
        foreach ($anchorTags as $anchor) {
            $href = $anchor->getAttribute('href');
            if (parse_url($href, PHP_URL_HOST) === $homePageDomain || Str::contains($href, $domain)) {
                $link = new Link();
                $link->url = $href;
                $link->save();
                $result[] = $href;
            }
        }
        return $result;
    }
}
