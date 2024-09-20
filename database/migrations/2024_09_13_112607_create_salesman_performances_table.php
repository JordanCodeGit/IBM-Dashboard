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
        Schema::create('salesman_performances', function (Blueprint $table) {
            $table->id('id_performa');
            $table->unsignedBigInteger('id_salesman');
            $table->foreign('id_salesman', 'sp_id_salesman')->references('id_salesman')->on('salesman');
            $table->date('periode');
            $table->unsignedBigInteger('id_kpi_absensi');
            $table->foreign('id_kpi_absensi', 'sp_id_kpi_absensi')->references('id_kpi')->on('key_performance_indices');
            $table->unsignedBigInteger('id_kpi_sales_reguler');
            $table->foreign('id_kpi_sales_reguler', 'sp_id_kpi_sales_reguler')->references('id_kpi')->on('key_performance_indices');
            $table->unsignedBigInteger('id_kpi_sales_kategori');
            $table->foreign('id_kpi_sales_kategori', 'sp_id_kpi_sales_kategori')->references('id_kpi')->on('key_performance_indices');
            $table->unsignedBigInteger('id_kpi_toko');
            $table->foreign('id_kpi_toko', 'sp_id_kpi_toko')->references('id_kpi')->on('key_performance_indices');
            $table->unsignedBigInteger('id_kpi_penagihan');
            $table->foreign('id_kpi_penagihan', 'sp_id_kpi_penagihan')->references('id_kpi')->on('key_performance_indices');
            $table->tinyInteger('total_poin', false, true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salesman_performances');
    }
};
