<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->integer('age_range');
            $table->string('title', 250);
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->string('image', 250)->nullable();
            $table->string('file_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sheets');
    }
};
