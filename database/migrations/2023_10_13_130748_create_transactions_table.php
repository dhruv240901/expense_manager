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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('transactiontype_id')->nullable();
            $table->foreign('transactiontype_id')->references('id')->on('transaction_types')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('transactioncategory_id')->nullable();
            $table->foreign('transactioncategory_id')->references('id')->on('transaction_categories')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('receiveraccount_id')->nullable();
            $table->foreign('receiveraccount_id')->references('id')->on('users')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
