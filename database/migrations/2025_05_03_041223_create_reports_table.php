<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('title');
            $table->text('description');
            $table->foreignId('reporter_id')->constrained('users');
            $table->enum('status', ['dilaporkan', 'diproses', 'selesai'])->default('dilaporkan');
            $table->text('resolution')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};