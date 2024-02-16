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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_id')->references('id')->on('catalogs');
            $table->text('name')->nullable();
            $table->text('url')->nullable();
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('stock')->default(0);
            $table->text('image')->nullable();
            $table->text('gallery')->nullable();
            $table->text('country')->nullable();
            $table->text('producer')->nullable();
            $table->text('material')->nullable();
            $table->text('main_material')->nullable();
            $table->text('size')->nullable();
            $table->text('color')->nullable();
            $table->text('sbis_id')->nullable();
            $table->text('description_simple')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
