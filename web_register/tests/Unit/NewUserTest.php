<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
// use tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\New_User;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class NewUserTest extends TestCase
{
    public function test_photo_upload()
    {
        // Simulate photo upload
        $photoPath = 'C:\Users\Lenovo\Pictures\for aliaa\Ovid.jpg';
        $this->assertFileExists($photoPath);
    }


    public function testEmailSending()
    {
        // Mock the email sending process for testing
        // Replace the email verification logic with your actual email sending logic
        Mail::fake();
        Mail::to('janedoe@example.com')->send(new RegisterMail('Jane Doe'));
        Mail::assertSent(RegisterMail::class, function ($mail) {
            return $mail->fullName === 'Jane Doe';
        });
    }

}
