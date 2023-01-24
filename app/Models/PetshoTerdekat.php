<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetshoTerdekat extends Model
{
    protected $table = 'petshop_terdekat';
    protected $fillable = ['nama_petshop','keterangan_petshop','gmaps_iframe','kab_kota_id'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function kab_kota()
    {
        return $this->hasMany(PembelianProduk::class, 'ras_hewan_id');
    }
}
