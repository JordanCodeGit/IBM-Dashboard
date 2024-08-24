<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    public $timestamps = false;

    protected $guarded = ['id_transaksi'];

    public function salesman(): BelongsTo
    {
        return $this->belongsTo(Salesman::class, 'id_salesman', 'id_salesman');
    }

    public function transaksi_barang(): HasMany
    {
        return $this->hasMany(Transaksi_Barang::class, 'id_transaksi', 'id_transaksi');
    }
}
