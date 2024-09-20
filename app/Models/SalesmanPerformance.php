<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SalesmanPerformance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id_performa'
    ];

    public function salesman(): BelongsTo {
        return $this->belongsTo(Salesman::class, 'id_salesman', 'id_salesman');
    }

    public function absensi(): HasOne {
        return $this->HasOne(KeyPerformanceIndex::class, 'id_kpi', 'id_kpi_absensi');
    }

    public function reguler(): HasOne {
        return $this->HasOne(KeyPerformanceIndex::class, 'id_kpi', 'id_kpi_sales_reguler');
    }

    public function kategori(): HasOne {
        return $this->HasOne(KeyPerformanceIndex::class, 'id_kpi', 'id_kpi_sales_kategori');
    }

    public function toko(): HasOne {
        return $this->HasOne(KeyPerformanceIndex::class, 'id_kpi', 'id_kpi_toko');
    }

    public function penagihan(): HasOne {
        return $this->HasOne(KeyPerformanceIndex::class, 'id_kpi', 'id_kpi_penagihan');
    }
}
