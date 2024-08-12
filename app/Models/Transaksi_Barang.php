<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_Barang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_barang';

    public $timestamps = false;

    protected $guarded = ['id_transaksi_barang'];
}
