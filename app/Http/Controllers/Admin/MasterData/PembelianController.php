<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PembelianProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    public $title = 'Pembelian Asuransi Member';
    public function index()
    {
        return view('admin.master-data.pembelian', [
            'title'=>$this->title
        ]);
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
                        return '<a href="'.$link.'" class="btn btn-success btn-sm">Check <i class="bi bi-search"></i></a>';
                    } elseif ($row->status_pembelian->id==2) {
                        return '<span class="badge text-bg-danger shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } elseif ($row->status_pembelian->id==3) {
                        return '<span class="badge text-bg-success shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } else {
                        return '<span class="badge text-bg-warning shadow-sm">'.$row->status_pembelian->status.'</span>';
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
                        return '<span class="badge text-bg-danger shadow-sm">'.$row->status_pembelian->status.'</span>';
                    } elseif ($row->status_pembelian->id==3) {
                        return '<span class="badge text-bg-success shadow-sm">'.$row->status_pembelian->status.'</span>';
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
        if (!empty($request->id)){
            try {
                DB::beginTransaction();
                $data = PembelianProduk::find($request->pembelian_id);

                // Generate Polis dalam bentuk pdf

                
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

