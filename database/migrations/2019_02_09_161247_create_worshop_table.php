<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workshop', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->string('city');
            $table->integer('postal');
            $table->integer('price');
            $table->string('org_type');
            $table->integer('age_mini');
            $table->integer('age_maxi');
            $table->integer('effectif_max');
            $table->date('date');
            $table->string('begining');
            $table->string('end');
            $table->longText('description');
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshop');
    }
};
