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
        Schema::dropIfExists('kredit');
        Schema::dropIfExists('beli_cash');


        Schema::create('orders', function (Blueprint $table) {
            $table->string('kode_transaksi')->primary();
            $table->string('ktp');
            $table->string('kode_mobil');
            $table->string('kode_paket')->nullable();
            $table->enum('type_pembayaran', ['cash', 'kredit'])->default('kredit');
            $table->string('total_harga');
            $table->string('total_pembayaran'); // dp kalau kredit
            $table->date('tanggal_bayar');
            $table->text('fotokopi_ktp')->nullable();
            $table->text('fotokopi_kk')->nullable();
            $table->text('fotokopi_slip_gaji')->nullable();
            $table->timestamps();

            $table->foreign('KTP')->references('KTP')->on('pembeli')->onDelete('cascade');
            $table->foreign('kode_mobil')->references('kode_mobil')->on('mobil')->onDelete('cascade');
            $table->foreign('kode_paket')->references('kode_paket')->on('paket_kredit')->onDelete('cascade');
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
