<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->integer('begining');
            $table->integer('end');
        });
    }

    public function down(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->string('duration');
            $table->dropColumn('begining');
            $table->dropColumn('end');
        });
    }
};
