<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorRekeningBank extends Model
{
    use HasFactory;

    protected $table = 'nomor_rekening_bank_payment';
    protected $fillable = ['bank_id','nomor_rekening'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function master_bank()
    {
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }
}
