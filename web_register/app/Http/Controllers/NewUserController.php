<?php

namespace App\Http\Controllers;

use App\Models\New_User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class NewUserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string',
            'name' => ['required', 'string', Rule::unique('new_user', 'username')],
            'birthdate' => 'required|date',
            'phone' => 'required|string|',
            'address' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('uploads');
        } else {
            return redirect()->back()->with('error', 'Image Upload Failed');
        }

        try {
            $user = New_User::create([
                'fullName' => $validatedData['fname'],
                'username' => $validatedData['name'],
                'birthdate' => $validatedData['birthdate'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'password' => bcrypt($validatedData['password']), // Hashing the password
                'email' => $validatedData['email'],
                'imageName' => $imagePath,
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            // If the username already exists, return a response indicating so
            if ($exception->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                return response()->json(['error' => 'Username already exists']);
            }
            // Otherwise, rethrow the exception
            throw $exception;
        }

        if ($user) {
            // Send email
            Mail::to('mostafaalielshemy55@gmail.com')->send(new RegisterMail($validatedData['fname']));

            return response()->json(['success' => "User Registered Successfully"]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
