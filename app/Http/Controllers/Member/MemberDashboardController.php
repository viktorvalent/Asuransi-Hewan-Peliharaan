<?php

namespace App\Http\Controllers\Member;

use Exception;
use App\Helper;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\PolisAsuransi;
use App\Models\PembelianProduk;
use App\Models\MasterBankMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\KlaimAsuransi;
use Illuminate\Support\Facades\Storage;
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

    public function edit($id)
    {
        $bank = MasterBankMember::all();
        $member = Member::find($id);
        return view('member.edit-profile', [
            'title'=>'Edit Member Profile',
            'banks'=>$bank,
            'data'=>$member
        ]);
    }

    public function update(Request $request)
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
            '*.required' => 'Tidak boleh kosong!'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $member = Member::find($request->member_id);
                if ($member->no_ktp==$request->nik) {
                    $member->update([
                        'nama_lengkap' => $request->nama,
                        'no_ktp' => $request->nik,
                        'no_hp' => $request->nohp,
                        'alamat' => $request->alamat,
                        'bank_id' => $request->bank,
                        'no_rekening' => $request->rek,
                    ]);
                    Helper::createUserLog("Berhasil update data member ".$request->nama, auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = Member::where('no_ktp','=',$request->nik)->whereNot('id',$request->member_id)->first();
                    if ($cek) {
                        return response()->json([
                            'status'=>404,
                            'message'=>'No KTP telah digunakan!'
                        ],404);
                    } else {
                        $member->update([
                            'nama_lengkap' => $request->nama,
                            'no_ktp' => $request->nik,
                            'no_hp' => $request->nohp,
                            'alamat' => $request->alamat,
                            'bank_id' => $request->bank,
                            'no_rekening' => $request->rek,
                        ]);
                        Helper::createUserLog("Berhasil update data member ".$request->nama, auth()->user()->id, $this->title);
                        DB::commit();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Berhasil mengubah data'
                        ]);
                    }
                }
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal update data member ".$request->nama, auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
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

    public function klaim()
    {
        $member = Member::with('klaims')->where('user_id',auth()->user()->id)->first();
        $klaim = KlaimAsuransi::with('status_set','polis')->where('member_id',$member->id)->latest()->get();
        $pembelian = PembelianProduk::with('polis','produk')->where('member_id',$member->id)->where('status',3)->get();
        return view('member.klaim',[
            'title'=>'Klaim Asuransi',
            'member'=>$member,
            'klaims'=>$klaim,
            'pembelians'=>$pembelian
        ]);
    }

    public function form_klaim()
    {
        $member = Member::where('user_id',auth()->user()->id)->first();
        $pembelian = PembelianProduk::with('polis','produk')->where('member_id',$member->id)->where('status',3)->get();
        return view('member.form-klaim',[
            'title'=>'Form Klaim',
            'pembelians'=>$pembelian,
            'member'=>$member
        ]);
    }

    public function revisi_klaim($id)
    {
        $member = Member::where('user_id',auth()->user()->id)->first();
        $pembelian = PembelianProduk::with('polis','produk')->where('member_id',$member->id)->where('status',3)->get();
        $klaim = KlaimAsuransi::find($id);
        return view('member.revisi-klaim',[
            'title'=>'Form Klaim',
            'pembelians'=>$pembelian,
            'member'=>$member,
            'data'=>$klaim
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
            '*.required' => 'Tidak boleh kosong!'
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

    public function get_polis($id)
    {
        $unduh = PolisAsuransi::select('pembelian_id','path')->where('pembelian_id',$id)->first();
        if ($unduh) {
            Helper::createUserLog("Berhasil download polis untuk member ".$unduh->pembelian->member->nama_lengkap, auth()->user()->id, $this->title);
            if (Storage::exists($unduh->path)) {
                return Storage::download($unduh->path);
            }
        } else {
            Helper::createUserLog("Gagal download polis untuk member ".$unduh->pembelian->member->nama_lengkap, auth()->user()->id, $this->title);
            return response()->json([
                'status'=>422,
                'message'=>'Polis tidak tersedia/rusak'
            ],422);
        }

    }

    public function get_nota_klaim($id)
    {
        $unduh = KlaimAsuransi::with('member')->select('path','member_id')->where('id',$id)->first();
        if ($unduh) {
            Helper::createUserLog("Berhasil download polis untuk member ".$unduh->member->nama_lengkap, auth()->user()->id, $this->title);
            if (Storage::exists($unduh->path)) {
                return Storage::download($unduh->path);
            }
        } else {
            Helper::createUserLog("Gagal download polis untuk member ".$unduh->member->nama_lengkap, auth()->user()->id, $this->title);
            return response()->json([
                'status'=>422,
                'message'=>'Polis tidak tersedia/rusak'
            ],422);
        }
    }
}
