<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('conversations', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('workshop_id');
        $table->unsignedInteger('participant_id');
        $table->unsignedInteger('organizer_id');
        $table->timestamps();

        $table->foreign('workshop_id')->references('id')->on('workshop')->onDelete('cascade');
        $table->foreign('participant_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
        $table->unique(['workshop_id', 'participant_id']);
    });
}
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};