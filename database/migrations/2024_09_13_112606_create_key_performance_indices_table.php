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
        Schema::create('key_performance_indices', function (Blueprint $table) {
            $table->id('id_kpi');
            $table->unsignedInteger('target');
            $table->unsignedInteger('pencapaian');
            $table->decimal('persentase', 3, 2);
            $table->decimal('poin', 3, 1);
            $table->enum('tipe_indeks', ['absensi', 'sales_reguler', 'sales_kategori', 'toko', 'penagihan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_performance_indices');
    }
};
