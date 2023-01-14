<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermAndConditions extends Model
{
    use HasFactory;

    protected $table = 'term_and_conditions';
    protected $fillable = ['isi'];
    public $timestamps = true;
    protected $primaryKey = 'id';
}
