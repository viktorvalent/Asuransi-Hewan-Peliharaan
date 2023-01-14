<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public $title = 'Dashboard';

    public function index()
    {
        abort_if(!auth()->user()->role==1, 403);

        return view('admin.app',[
            'title'=>$this->title
        ]);
    }
}
