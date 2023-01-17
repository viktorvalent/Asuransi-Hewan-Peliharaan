<?php

namespace App\Http\Controllers\Member;

use Exception;
use Illuminate\Http\Request;
use App\Models\MasterRasHewan;
use App\Models\ProdukAsuransi;
use App\Models\MasterJenisHewan;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = ProdukAsuransi::select('id','nama_produk')->get();
        $jenis = MasterJenisHewan::select('id','nama')->get();
        return view('member.beli-produk',[
            'title'=>'Pembelian',
            'produks'=>$produk,
            'jeniss'=>$jenis
        ]);
    }

    public function get_ras($id)
    {
        $ras = MasterRasHewan::select('id','nama_ras')->where('jenis_hewan_id',$id)->get();
            if ($ras) {
                return response()->json([
                    'status'=>200,
                    'ras'=>$ras
                ]);
            } else {
                return response()->json([
                    'status'=>404,
                    'message'=>'Data tidak ditemukan'
                ],404);
            }
    }
}
