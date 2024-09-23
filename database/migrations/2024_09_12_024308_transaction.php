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
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('order_id_midtrans');
            $table->enum('status', ['Sedang Diproses', 'Dalam Pengiriman Jasa Ekspedisi', 'Dibatalkan', 'Sudah Diterima', 'Sudah dibayar', 'Belum dibayar']);
            $table->decimal('total_price',10,2);
            $table->decimal('shipping_cost', 10, 2); // Ongkos kirim dari Raja Ongkir
            $table->string('courier'); // Nama jasa ekspedisi (JNE, TIKI, dll)
            $table->string('shipping_service'); // Jenis layanan pengiriman (Reguler, YES, dll)
            $table->string('estimate');
            $table->date('date');
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
