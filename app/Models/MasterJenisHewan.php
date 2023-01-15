<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisHewan extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_hewan';
    protected $fillable = ['nama','deskripsi'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function ras_hewan()
    {
        return $this->hasMany(MasterRasHewan::class, 'ras_hewan_id');
    }
}