<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $fillable = ['nama_role'];
    public $timestamps = true;
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->hasMany(User::class, 'role');
    }
}
