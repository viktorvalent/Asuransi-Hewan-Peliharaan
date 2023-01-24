<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKabKota extends Model
{
    protected $table = 'master_kab_kota';
    protected $fillable = ['nama','deskripsi','provinsi_id'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function provinsi()
    {
        return $this->belongsTo(MasterProvinsi::class, 'provinsi_id');
    }
}
