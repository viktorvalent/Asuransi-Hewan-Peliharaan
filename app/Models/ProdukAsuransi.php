<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAsuransi extends Model
{
    use HasFactory;

    public function pembelian_produk()
    {
        return $this->hasMany(PembelianProduk::class, 'produk_id');
    }
}
