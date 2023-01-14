<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBankMember extends Model
{
    use HasFactory;

    protected $table = 'master_bank';
    protected $fillable = ['nama','deskripsi'];
    protected $primaryKey = 'id';

    public function member()
    {
        return $this->hasMany(Member::class, 'bank_id');
    }
}
