<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



class APITest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    public function testAPIResponse()
    {
        // Mock the external API response for testing
        // Replace the route with your actual route for fetching actors
        $response = $this->post('/actors', ['birthdate' => '1990-01-01']);
        $response->assertStatus(200);
        // Add more assertions based on the expected response from the API
    }

}
