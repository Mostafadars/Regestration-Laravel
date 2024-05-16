<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\New_User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class RegisterTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    public function testRegistrationFormView()
    {
        $response = $this->get('/en');
        $response->assertStatus(200);
    }

    public function testRegistrationFormValidation()
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['fname', 'name', 'birthdate', 'phone', 'address', 'password', 'email', 'photo']);
    }

}
