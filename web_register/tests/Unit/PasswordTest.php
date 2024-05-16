<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    public function test_password_hashing()
    {
        $password = 'password123';
        $hashedPassword = bcrypt($password);

        // Manually verify the hashed password
        $this->assertTrue(password_verify($password, $hashedPassword));
    }
}
