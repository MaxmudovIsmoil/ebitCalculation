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
        Schema::create('road_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('roadId');
            $table->integer('stage');
            $table->unsignedBigInteger('instanceId');
//            $table->unique(['stage', 'roadId']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('roadId')->references('id')->on('roads')->onDelete('cascade');
            $table->foreign('instanceId')->references('id')->on('instances')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_maps');
    }
};
