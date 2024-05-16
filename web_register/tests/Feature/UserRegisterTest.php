<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\New_User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class UserRegisterTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    public function testUserRegistration()
    {
        // You need to provide valid form data for registration here
        $response = $this->post('/register', [
            'fname' => 'John Doe',
            'name' => 'johndoe123',
            'birthdate' => '1990-01-01',
            'phone' => '0123456789',
            'address' => '123 Street, City',
            'password' => 'Password123!',
            'email' => 'johndoe@example.com',
            'photo' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $response->assertStatus(Response::HTTP_OK); // Assuming you're returning HTTP 200 for successful registration
        $response->assertJson([
            'success' => true, // Assuming the success response contains a 'success' key with value true
        ]);
    }
}
