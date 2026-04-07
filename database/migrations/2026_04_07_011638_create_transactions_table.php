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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            // tipe transaksi bisa berupa konsultasi, pembelian produk, atau janji temu pakai enum
            $table->enum('transaction_type', ['consultation', 'product_purchase', 'appointment']);
            $table->string('payment_method');
            // status transaksi bisa berupa pending, completed, atau cancelled
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            // total price disimpan dalam bentuk integer untuk memudahkan perhitungan (decimal 10,2)
            $table->decimal('total_price', 10, 2);
            $table->text('notes')->nullable();
            $table->string('date');
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
