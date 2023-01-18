<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembelianSetting extends Model
{
    use HasFactory;

    protected $table = 'status_pembelian_setting';
    protected $fillable = ['status'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function pembelian_produk()
    {
        return $this->hasMany(PembelianProduk::class, 'status');
    }
}
