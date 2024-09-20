<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeyPerformanceIndex extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id_kpi'
    ];

    public function absensi(): BelongsTo
    {
        return $this->belongsTo(SalesmanPerformance::class, 'id_kpi', 'id_kpi_absensi');
    }

    public function reguler(): BelongsTo
    {
        return $this->belongsTo(SalesmanPerformance::class, 'id_kpi', 'id_kpi_sales_reguler');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(SalesmanPerformance::class, 'id_kpi', 'id_kpi_sales_kategori');
    }

    public function toko(): BelongsTo
    {
        return $this->belongsTo(SalesmanPerformance::class, 'id_kpi', 'id_kpi_toko');
    }

    public function penagihan(): BelongsTo
    {
        return $this->belongsTo(SalesmanPerformance::class, 'id_kpi', 'id_kpi_penagihan');
    }
}
