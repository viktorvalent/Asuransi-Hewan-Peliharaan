<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRasHewan extends Model
{
    use HasFactory;

    public function pembelian_produk()
    {
        return $this->hasMany(PembelianProduk::class, 'ras_hewan_id');
    }

    public function jenis_hewan()
    {
        return $this->hasMany(MasterJenisHewan::class, 'jenis_hewan_id');
    }
}
