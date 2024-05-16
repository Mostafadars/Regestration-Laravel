<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail()
    {
        $validator = Validator::make(['email' => 'test@example.com'], [
            'email' => 'required|email',
        ]);

        $this->assertTrue($validator->passes());
    }

    public function testInvalidEmail()
    {
        // Test invalid email format
        $validator = Validator::make(['email' => 'invalid-email'], [
            'email' => 'required|email',
        ]);

        $this->assertFalse($validator->passes());
    }
}
