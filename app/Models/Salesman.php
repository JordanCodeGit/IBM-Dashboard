<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salesman extends Model
{
    use HasFactory;

    protected $table = 'salesman';

    public $timestamps = false;

    protected $guarded = [
        'id_salesman'
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_salesman', 'id_salesman');
    }
}
