<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use Illuminate\Http\Request;
use App\Models\ProdukAsuransi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProdukBenefit;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProdukAsuransiController extends Controller
{
    public $title = 'Produk Asuransi';

    public function index()
    {
        return view('admin.master-data.produk-asuransi', [
            'title' => $this->title,
        ]);
    }

    public function addProduk()
    {
        return view('admin.master-data.add-produk-asuransi',[
            'title' => 'Tambah Produk Asuransi'
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = ProdukAsuransi::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->editColumn('nama_produk', function($row){
                    $url = URL::route('master-data.produk-asuransi.detail', $row->id);
                    return '<a href="'.$url.'" class="fw-bold">'.$row->nama_produk.'</a>';
                })
                ->rawColumns(['action','nama_produk'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kelas_kamar' => 'required',
            'limit_kamar' => 'required',
            'limit_obat' => 'required',
            'satuan_limit_kamar' => 'required',
            'satuan_limit_obat' => 'required',
            'satuan_limit_dokter' => 'required',
            'nilai_pertanggungan_min' => 'required',
            'nilai_pertanggungan_max' => 'required',
            'santunan_mati_kecelakaan' => 'required',
            'santunan_kecurian' => 'required',
            'tanggung_jawab_hukum' => 'required',
            'santunan_kremasi' => 'required',
            'santunan_rawat_inap' => 'required',
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
                $produk = ProdukAsuransi::create([
                    'nama_produk' => $request->nama_produk,
                    'kelas_kamar' => $request->kelas_kamar,
                    'limit_kamar' => $request->limit_kamar,
                    'limit_obat' => $request->limit_obat,
                    'satuan_limit_kamar' => $request->satuan_limit_kamar,
                    'satuan_limit_obat' => $request->satuan_limit_obat,
                    'satuan_limit_dokter' => $request->satuan_limit_dokter,
                ]);

                if($produk) {
                    ProdukBenefit::create([
                        'produk_id' => $produk->id,
                        'nilai_pertanggungan_min' => $request->nilai_pertanggungan_min,
                        'nilai_pertanggungan_max' => $request->nilai_pertanggungan_max,
                        'santunan_mati_kecelakaan_max' => $request->santunan_mati_kecelakaan,
                        'santunan_pencurian_max' => $request->santunan_kecurian,
                        'hukum_pihak_ketiga_max' => $request->tanggung_jawab_hukum,
                        'santunan_kremasi_max' => $request->santunan_kremasi,
                        'santunan_rawat_inap_max' => $request->santunan_rawat_inap
                    ]);
                }
                Helper::createUserLog("Berhasil menambahkan produk asuransi ".$produk->nama_produk, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan produk'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah produk asuransi", auth()->user()->id, $this->title);
                return response()->json([
                    'status'=>422,
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }
}
