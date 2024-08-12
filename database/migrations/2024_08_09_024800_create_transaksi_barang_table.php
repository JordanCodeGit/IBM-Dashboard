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
        Schema::create('transaksi_barang', function (Blueprint $table) {
            $table->id('id_transaksi_barang');
            $table->foreignId('id_transaksi');
            $table->foreignId('id_barang');
            $table->smallInteger('kuantitas')->unsigned();
            $table->boolean('negosiasi');
            $table->mediumInteger('harga_nego')->nullable()->unsigned();
            $table->integer('total')->unsigned();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_barang');
    }
};
