<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    public $timestamps = false;

    protected $guarded = ['id_barang'];

    public function transaksi_barang(): HasMany
    {
        return $this->hasMany(Transaksi_Barang::class, 'id_barang', 'id_barang');
    }
}
