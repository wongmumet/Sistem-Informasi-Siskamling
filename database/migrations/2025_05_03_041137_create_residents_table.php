<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->enum('gender', ['L', 'P']);
            $table->date('birth_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
};