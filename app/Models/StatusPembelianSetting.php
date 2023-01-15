<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembelianSetting extends Model
{
    use HasFactory;

    public function pembelian_produk()
    {
        return $this->hasMany(PembelianProduk::class, 'status');
    }
}
