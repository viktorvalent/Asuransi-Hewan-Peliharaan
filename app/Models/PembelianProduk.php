<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianProduk extends Model
{
    use HasFactory;

    protected $table = 'pembelian_produk';
    protected $fillable = ['tgl_daftar_asuransi','biaya_pendaftaran','member_id','ras_hewan_id','produk_id','nama_hewan','tgl_lahir_hewan','foto_hewan','harga_dasar_premi','status'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function produk()
    {
        return $this->belongsTo(ProdukAsuransi::class, 'produk_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusPembelianSetting::class, 'status');
    }

    public function ras_hewan()
    {
        return $this->belongsTo(MasterRasHewan::class, 'ras_hewan_id');
    }
}
