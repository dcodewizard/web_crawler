<?php

namespace Tests\Unit;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetHomepageLinks()
    {
        $inputString = 'https://www.google.com';

        $response = $this->post('get-homepage-links', ['inputString' => $inputString]);
        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('links');
        $links = $response->viewData('links');
        $this->assertIsArray($links);
        $this->assertNotEmpty($links);
    }
}
