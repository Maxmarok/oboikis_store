<?php

use App\Enums\StatusEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('comment')->nullable();
            $table->string('reciever')->nullable();
            $table->string('delivery')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', StatusEnum::all())->default(StatusEnum::NEW);
            $table->text('saleKey')->nullable();
            $table->text('paymentRef')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
