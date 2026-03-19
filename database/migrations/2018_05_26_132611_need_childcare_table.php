<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('create_childcare', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('children');
            $table->string('duration');
            $table->string('day');
            $table->string('location');
            $table->integer('age_range');
            $table->integer('accepted')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('create_childcare');
    }
};
