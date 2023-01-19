<?php

namespace App\Http\Controllers\Admin\MasterData;

use PDF;
use Exception;
use App\Helper;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PolisAsuransi;
use App\Models\PembelianProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    public $title = 'Pembelian Asuransi Member';
    public function index()
    {
        return view('admin.master-data.pembelian', [
            'title'=>$this->title
        ]);
    }

    public function test_pdf($id)
    {
        $data = PembelianProduk::with('produk','ras_hewan.jenis_hewan','member','polis')->find($id);
        view()->share('data',['data'=>$data]);
        $pdf = PDF::loadView('template.polis-asuransi', ['data'=>$data]);
        return $pdf->download('polis.pdf');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = PembelianProduk::with('produk','ras_hewan.jenis_hewan','member')->where('pay_status',true)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link = URL::route('pembelian.detail',['id'=>$row->id]);
                    if ($row->status_pembelian->id==1) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } elseif ($row->status_pembelian->id==2) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } elseif ($row->status_pembelian->id==3) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } else {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    }
                })
                ->editColumn('tgl_daftar_asuransi', function($row){
                    return Carbon::createFromFormat('Y-m-d', $row->tgl_daftar_asuransi, 'Asia/Jakarta')->format('d-m-Y');
                })
                ->editColumn('produk_id.produk.nama_produk', function($row){
                    return $row->produk->nama_produk;
                })
                ->editColumn('member_id.member.nama_lengkap', function($row){
                    return $row->member->nama_lengkap;
                })
                ->editColumn('ras_hewan_id.ras_hewan.nama_ras', function($row){
                    $jenis = $row->ras_hewan->jenis_hewan->nama;
                    $ras = $row->ras_hewan->nama_ras;

                    return ''.$jenis.' ( Ras '.$ras.' )';
                })
                ->editColumn('status.status_pembelian.nama', function($row){
                    if ($row->status_pembelian->id==1) {
                        return '<span class="badge text-bg-light shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } elseif ($row->status_pembelian->id==2) {
                        return '<span class="badge text-bg-danger text-white shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } elseif ($row->status_pembelian->id==3) {
                        return '<span class="badge text-bg-success text-white shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } else {
                        return '<span class="badge text-bg-warning shadow-sm">'.$row->status_pembelian->status.'</span>';
                    }
                })
                ->rawColumns(['action','status.status_pembelian.nama'])
                ->make(true);
        }
    }

    public function check_detail($id)
    {
        $data = PembelianProduk::with('produk','ras_hewan.jenis_hewan','member')->find($id);

        return view('admin.master-data.detail-pembelian', [
            'title'=>'Detail Pembelian Asuransi Member',
            'data'=>$data
        ]);
    }

    public function confirm_pembelian(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tgl_mulai' => 'required',
            'jangka_waktu' => 'required'
        ],
        [
            '*.required' => 'Wajib diisi!'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            if (!empty($request->id)){
                try {
                    DB::beginTransaction();
                    $polis = PolisAsuransi::create([
                        'nomor_polis'=>Helper::generatePolisNumber(),
                        'pembelian_id'=>$request->id,
                        'tgl_polis_mulai'=>$request->tgl_mulai,
                        'tgl_polis_dibuat'=>Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                        'jangka_waktu'=>$request->jangka_waktu,
                        'status_polis'=>'Aktif',
                        'biaya_polis'=>null,
                        'tgl_bayar_polis'=>null,
                        'path'=>'-'
                    ]);

                    if ($polis) {
                        $data = PembelianProduk::with('produk','ras_hewan.jenis_hewan','member','polis')->find($request->id);
                        if ($data) {
                            view()->share('data',['data'=>$data]);
                            $pdf = PDF::loadView('template.polis-asuransi', ['data'=>$data]);
                            $date = Str::remove('-', strval(Carbon::now()->format('Y-m-d')));
                            $pdf_file = $pdf->download()->getOriginalContent();
                            $member = Str::slug($data->member->nama_lengkap,'-');
                            $path = strval('public/polis-asuransi/'.$member.'/MYPETT_POLIS_'.$date.'_'.strval(md5($data->member_id)).'.pdf');
                            Storage::put($path, $pdf_file);
                            if (Storage::exists($path)) {
                                PembelianProduk::where('id',$request->id)->update(['status'=>3]);
                                $polis->path = $path;
                                $polis->save();
                            }
                        }
                    }

                    Helper::createUserLog("Berhasil konfirmasi pembelian untuk member ".$data->member->nama_lengkap, auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil menambahkan data rekening'
                    ]);
                } catch (Exception $e) {
                    DB::rollBack();
                    Helper::createUserLog("Gagal konfirmasi pembelian", auth()->user()->id, $this->title);
                    return response()->json([
                        'message'=>$e->getMessage()
                    ],422);
                }
            } else {
                return response()->json([
                    'status'=>404,
                    'message'=>'Data pembelian expired!'
                ],404);
            }
        }
    }
}

