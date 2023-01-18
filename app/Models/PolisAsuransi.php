<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolisAsuransi extends Model
{
    protected $table = 'polis_asuransi';
    protected $fillable = ['pembelian_id','warna','icon','harga','produk_id'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function pembelian()
    {
        return $this->belongsTo(PembelianProduk::class, 'pembelian_id');
    }
}
