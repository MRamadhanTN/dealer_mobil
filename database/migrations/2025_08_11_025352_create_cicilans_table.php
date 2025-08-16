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
        Schema::dropIfExists('bayar_cicilan');

        Schema::create('cicilans', function (Blueprint $table) {
            $table->string('kode_cicilan')->primary();
            $table->string('kode_transaksi');
            $table->enum('status_cicilan', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->date('jatuh_tempo');
            $table->integer('total_bayar');
            $table->integer('cicilan_ke');
            $table->timestamps();

            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cicilans');
    }
};
