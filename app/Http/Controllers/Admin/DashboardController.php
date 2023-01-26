<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\KlaimAsuransi;
use App\Models\PolisAsuransi;
use App\Models\PembelianProduk;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public $title = 'Dashboard';

    public function index()
    {
        $data['member'] = Member::count();
        $data['asuransi'] = PembelianProduk::count();
        $data['polis'] = PolisAsuransi::count();
        $data['klaim'] = KlaimAsuransi::count();
        $data['chart'] = json_encode(Helper::chartData());
        // $currentDate = \Carbon\Carbon::now();
        // $agoDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
        return view('admin.app',[
            'title'=>$this->title,
            'data'=>$data
        ]);
    }

    public function profile()
    {
        $data = User::select('username','email','password','role')->find(auth()->user()->id);
        return view('admin.profile', [
            'data'=>$data,
            'title'=>'Profile'
        ]);
    }
}
