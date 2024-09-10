<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('roadId');
            $table->unsignedBigInteger('instanceId');
            $table->string('name');
            $table->date('date');
            $table->string('client');
            $table->string('address');
            $table->string('materialCost');
            $table->string('monthlyPayment');
            $table->string('paymentDate');
            $table->integer('allStage');
            $table->unsignedBigInteger('currentInstanceId');
            $table->integer('currentStage');
            $table->enum('status', OrderStatus::toArray())->default(1)->comment('1-processing,2-accepted,3-go back,4-declined,5-completed');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('instanceId')->references('id')->on('instances')->onDelete('restrict');
            $table->foreign('currentInstanceId')->references('id')->on('instances')->onDelete('restrict');
            $table->foreign('roadId')->references('id')->on('roads')->onDelete('restrict');
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
