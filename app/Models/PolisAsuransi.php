<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolisAsuransi extends Model
{
    protected $table = 'polis_asuransi';
    protected $fillable = ['pembelian_id','nomor_polis','tgl_polis_mulai','tgl_polis_dibuat','jangka_waktu','biaya_polis','tgl_bayar_polis','status_polis','path'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function pembelian()
    {
        return $this->belongsTo(PembelianProduk::class, 'pembelian_id');
    }
}
