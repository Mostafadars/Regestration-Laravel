<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('New_User', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('username');
            $table->date('birthdate');
            $table->string('phone');
            $table->string('address');
            $table->string('password');
            $table->string('email');
            $table->string('imageName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('New_User');
    }
};
