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
        Schema::create('order_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId');
            $table->unsignedBigInteger('roadId')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('instanceId')->nullable();
            $table->string('stage')->nullable();
            $table->string('status')->nullable();
            $table->string('comment')->default('');
            $table->string('timeSigned')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('roadId')->references('id')->on('roads')->onDelete('restrict');
            $table->foreign('instanceId')->references('id')->on('instances')->onDelete('restrict');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_actions');
    }
};
