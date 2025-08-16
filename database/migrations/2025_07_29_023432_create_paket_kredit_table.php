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
        Schema::create('paket_kredit', function (Blueprint $table) {
            $table->string('kode_paket')->primary();
            $table->integer('harga_min');
            $table->integer('harga_max');
            $table->integer('uang_muka');
            $table->integer('jumlah_cicilan');
            $table->float('bunga', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_kredit');
    }
};
