<?php

namespace App\Http\Controllers\Admin\MasterData;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\KlaimAsuransi;
use App\Models\PolisAsuransi;

class PolisController extends Controller
{
    public $title = 'Polis Asuransi Member';

    public function index()
    {
        return view('admin.transaksi.polis', [
            'title'=>$this->title
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = PolisAsuransi::with('pembelian.member')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->editColumn('pembelian_id.member.nama_lengkap', function($row){
                    return $row->pembelian->member->nama_lengkap;
                })
                ->editColumn('jangka_waktu', function($row){
                    return $row->jangka_waktu.' Tahun';
                })
                ->editColumn('nomor_polis', function($row){
                    $link = URL::route('polis.preview',['id'=>$row->id]);
                    return '<a href="'.$link.'" class="fw-bold">'.$row->nomor_polis.'</a>';
                })
                ->editColumn('tgl_polis_mulai', function($row){
                    return Carbon::createFromFormat('Y-m-d',$row->tgl_polis_mulai)->format('d-m-Y');
                })
                ->rawColumns(['action','pembelian_id.member.nama_lengkap','nomor_polis'])
                ->make(true);
        }
    }

    public function polis_preview($id)
    {
        $data = PolisAsuransi::select('path','nomor_polis')->find($id);
        if ($data) {
            return view('admin.transaksi.polis-preview',[
                'data'=>$data,
                'title'=>'Polis Preview'
            ]);
        }
    }
}
