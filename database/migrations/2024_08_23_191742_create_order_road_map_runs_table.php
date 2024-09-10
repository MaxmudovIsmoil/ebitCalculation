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
        Schema::create('order_road_map_runs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId')->index();
            $table->unsignedBigInteger('roadId');
            $table->integer('stage');
            $table->unique(['orderId', 'stage']);
            $table->json('users')->nullable();
            $table->unsignedBigInteger('instanceId');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('roadId')->references('id')->on('roads')->onDelete('restrict');
            $table->foreign('instanceId')->references('id')->on('instances')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_road_map_runs');
    }
};
