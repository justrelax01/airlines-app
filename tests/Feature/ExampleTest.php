<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_loads()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function test_flights_page_loads()
    {
        $response = $this->get('/flights');
        $response->assertStatus(200);
    }

    public function test_faq_page_loads()
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
    }

    public function test_search_flights_page_loads()
    {
        $response = $this->get('/search-flights');
        $response->assertStatus(200);
    }

    public function test_login_page_loads()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_page_loads()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_dashboard_requires_authentication()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
