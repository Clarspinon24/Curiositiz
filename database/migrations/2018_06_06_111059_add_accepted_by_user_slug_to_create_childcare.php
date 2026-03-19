<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->string('accepted_by_user_slug')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('create_childcare', function (Blueprint $table) {
            $table->dropColumn('accepted_by_user_slug');
        });
    }
};
