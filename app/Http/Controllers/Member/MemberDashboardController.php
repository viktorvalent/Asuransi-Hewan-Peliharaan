<?php

namespace App\Http\Controllers\Member;

use Exception;
use App\Helper;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MasterBankMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PembelianProduk;
use Illuminate\Support\Facades\Validator;

class MemberDashboardController extends Controller
{
    public $title = 'Member Dashboard';

    public function index()
    {
        $bank = MasterBankMember::all();
        if(auth()->user()->member) {
            $member = Member::where('user_id',auth()->user()->id)->first();
        } else {
            $member = null;
        }
        return view('member.profile', [
            'title'=>'Member Profile',
            'banks'=>$bank,
            'member'=>$member
        ]);
    }

    public function my_insurance()
    {
        if(auth()->user()->member) {
            $member = Member::where('user_id',auth()->user()->id)->first();
            $pembelian = PembelianProduk::where(function($q)use($member){
                $q->where('member_id',$member->id)
                    ->where('pay_status',true);
            })->latest()->get();
        } else {
            $member = null;
        }

        return view('member.asuransi',[
            'title'=>'My Insurance',
            'member'=>$member,
            'pembelians'=>$pembelian
        ]);
    }

    public function store_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'bank' => 'required',
            'rek' => 'required',
        ],
        [
            '*.required' => 'Wajib diisi!'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                Member::create([
                    'user_id' => auth()->user()->id,
                    'nama_lengkap' => $request->nama,
                    'no_ktp' => $request->nik,
                    'no_hp' => $request->nohp,
                    'alamat' => $request->alamat,
                    'bank_id' => $request->bank,
                    'no_rekening' => $request->rek,
                ]);
                Helper::createUserLog("Berhasil menambahkan data member ".$request->nama, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah data member ".$request->nama, auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }
}
