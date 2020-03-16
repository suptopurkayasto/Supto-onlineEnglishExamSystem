<?php

namespace Tests\Feature\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanShowHomePageTest extends TestCase
{
    /** @test  */

    public function can_show_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
