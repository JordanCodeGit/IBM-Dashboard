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
            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi', 'tb_id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang', 'tb_id_barang')->references('id_barang')->on('barang');
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
