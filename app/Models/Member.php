<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $fillable = ['user_id'.'ban_ik','nama','no_ktp','alamat','no_hp','foto'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function master_bank()
    {
        return $this->belongsTo(MasterBankMember::class, 'bank_id');
    }
}
