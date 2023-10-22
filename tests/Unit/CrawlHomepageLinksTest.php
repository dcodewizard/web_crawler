<?php

namespace Tests\Unit;

use App\Console\Commands\CrawlHomepageLinks;
use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrawlHomepageLinksTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->artisan('crawl:homepage-links', ['inputString' => 'https://www.w3schools.com']);

        // Assert the expected outcomes
        // For example, check if database records are created, URLs are saved, etc.
        $this->assertCount(155, Link::all());
    }
}
