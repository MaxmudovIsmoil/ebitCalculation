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
        Schema::create('instance_users', function (Blueprint $table) {
            $table->unsignedBigInteger('instanceId');
            $table->unsignedBigInteger('userId');
            $table->integer('capitan')->nullable();
            $table->foreign('instanceId')->references('id')->on('instances')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instance_users');
    }
};
