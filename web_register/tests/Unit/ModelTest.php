<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\New_User;

class ModelTest extends TestCase
{
    public function testUserModelValidation()
    {
        $rules = [
            'fullName' => 'required|string',
            'username' => 'required|string|unique:new_user',
            'birthdate' => 'required|date',
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
            'imageName' => 'required|string',
        ];

        $validator = Validator::make([
            'fullName' => 'John Doe',
            'username' => 'johndoe123',
            'birthdate' => '1990-01-01',
            'phone' => '0123456789',
            'address' => '123 Street, City',
            'password' => 'Password123!',
            'email' => 'johndoe@example.com',
            'imageName' => 'avatar.jpg',
        ], $rules);

        $this->assertTrue($validator->passes());

        // Test invalid data
        $validator = Validator::make([
            'fullName' => 'John Doe',
            'username' => '', // Empty username
            'birthdate' => '1990-01-01',
            'phone' => '0123456789',
            'address' => '123 Street, City',
            'password' => 'Password123!',
            'email' => 'invalid-email', // Invalid email format
            'imageName' => 'avatar.jpg',
        ], $rules);

        $this->assertFalse($validator->passes());
    }
}
