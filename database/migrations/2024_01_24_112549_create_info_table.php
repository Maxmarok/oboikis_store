<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info', function (Blueprint $table) {
            $table->id();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('logo')->nullable();
            $table->text('vk')->nullable();
            $table->text('telegram')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('viber')->nullable();
            $table->text('instagram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info');
    }
};
