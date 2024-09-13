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
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('roadId')->nullable();
            $table->unsignedBigInteger('instanceId')->nullable();
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->string('client')->nullable();
            $table->string('address')->nullable();
            $table->text('preliminaryCost')->nullable();
            $table->text('contractPayment')->nullable();
            $table->string('subscriptionFee')->nullable();
            $table->string('monthlyPayment')->nullable();
            $table->string('paybackPeriod')->nullable();
            $table->string('constructionWork')->nullable();
            $table->string('comment')->nullable();
            $table->string('dueDay')->nullable();
            $table->integer('allStage')->nullable();
            $table->unsignedBigInteger('currentInstanceId')->nullable();
            $table->integer('currentStage')->nullable();
            $table->enum('status', OrderStatus::toArray())->default(1);
            $table->enum('resendStatus', [1, null])->nullable();
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
