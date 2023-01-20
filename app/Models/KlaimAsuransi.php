<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaimAsuransi extends Model
{
    use HasFactory;

    protected $table = 'klaim_asuransi';
    protected $fillable = ['tgl_klaim','status_klaim','member_id','polis_id','history_klaim','foto_bukti_bayar','foto_resep_obat','foto_diagnosa_dokter','nominal_bayar_rs','nominal_bayar_dokter','nominal_bayar_obat','nominal_disetujui','keterangan_klaim'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function polis()
    {
        return $this->belongsTo(PolisAsuransi::class, 'polis_id');
    }

    public function status_set()
    {
        return $this->belongsTo(StatusSet::class, 'status_klaim');
    }
}
