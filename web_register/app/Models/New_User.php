<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_User extends Model
{
    use HasFactory;
    protected $fillable = ['fullName', 'username', 'birthdate', 'phone', 'address', 'password', 'email', 'imageName'];
}
