<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MasterBankMember;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    public function index()
    {

        $bank = MasterBankMember::all();
        return view('member.dashboard', [
            'title'=>'Member Dashboard',
            'banks'=>$bank
        ]);
    }
}
