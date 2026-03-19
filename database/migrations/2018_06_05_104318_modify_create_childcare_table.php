<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->string('children')->change();
            $table->string('age_range')->change();
        });
    }

    public function down(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->integer('children')->change();
            $table->integer('age_range')->change();
        });
    }
};
