<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistMail;

use App\Http\Controllers\NewUserController;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [NewUserController::class, 'create'])->name('register.create');

Route::group(['prefix' => '{locale}'], function() {
    Route::get('/', [NewUserController::class, 'create'])->name('locale.register.create')->middleware('localization');
});

// Route::get('/register', [NewUserController::class, 'create'])->name('register.create')->middleware('localization');

Route::post('/register', [NewUserController::class, 'store'])->name('register.store');

Route::post('/actors', [ApiController::class, 'getActors'])->name('actors');

// Route::get('/send', function()
// {
//     $name  = "tayseer abdelkader";
//     Mail::to('flotaabdelkader@gmail.com') ->send(new RegistMail($name));
//     return response('Email was sent to '.$name.' successfully');

// });
