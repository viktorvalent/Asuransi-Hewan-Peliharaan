<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KlaimController extends Controller
{
    public $title = 'Klaim Asuransi Member';
    public function index()
    {
        return view('admin.master-data.klaim', [
            'title'=>$this->title
        ]);
    }
}
