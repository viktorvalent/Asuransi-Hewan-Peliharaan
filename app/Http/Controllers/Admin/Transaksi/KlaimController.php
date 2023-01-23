<?php

namespace App\Http\Controllers\Admin\Transaksi;

use PDF;
use Exception;
use App\Helper;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KlaimAsuransi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\TolakKlaimAsuransi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KlaimController extends Controller
{
    public $title = 'Klaim Asuransi Member';
    public function index()
    {
        return view('admin.transaksi.klaim',[
            'title'=>$this->title
        ]);
    }

    public function check_detail($id)
    {
        $data = KlaimAsuransi::with('polis','member','status_set')->find($id);

        return view('admin.transaksi.detail-klaim', [
            'title'=>'Detail Klaim Asuransi Member',
            'data'=>$data
        ]);
    }

    // for testing template pdf klaim
    public function pdf($id)
    {
        $data = KlaimAsuransi::with('polis','member','status_set')->find($id);
        view()->share('data',['data'=>$data]);
        $pdf = PDF::loadView('template.klaim-asuransi', ['data'=>$data]);
        return $pdf->download('polis.pdf');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = KlaimAsuransi::with('member','polis','status_set')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link = URL::route('klaim.detail',['id'=>$row->id]);
                    if ($row->status_set->id==1) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } elseif ($row->status_set->id==2) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } elseif ($row->status_set->id==3) {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    } else {
                        return '<a href="'.$link.'" class="btn btn-success btn-sm"><i class="bi bi-search"></i> Check</a>';
                    }
                })->editColumn('tgl_klaim', function($row){
                    return Carbon::createFromFormat('Y-m-d', $row->tgl_klaim, 'Asia/Jakarta')->format('d-m-Y');
                })
                ->editColumn('polis_id.polis.nomor_polis', function($row){
                    return $row->polis->nomor_polis;
                })
                ->editColumn('member_id.member.nama_lengkap', function($row){
                    return $row->member->nama_lengkap;
                })
                ->addColumn('total_klaim', function($row){
                    return 'Rp '.number_format(($row->nominal_bayar_rs+$row->nominal_bayar_dokter+$row->nominal_bayar_obat),0,'','.');
                })
                ->editColumn('status_klaim.status_set.status', function($row){
                    if ($row->status_set->id==1) {
                        return '<span class="badge text-bg-light shadow-sm">'.$row->status_set->status.'</span>';
                    } elseif ($row->status_set->id==2) {
                        return '<span class="badge text-bg-danger text-white shadow-sm">'.$row->status_set->status.'</span>';
                    } elseif ($row->status_set->id==3) {
                        return '<span class="badge text-bg-success text-white shadow-sm">'.$row->status_set->status.'</span>';
                    } else {
                        return '<span class="badge text-bg-warning shadow-sm">'.$row->status_set->status.'</span>';
                    }
                })
                ->rawColumns(['action','status_klaim.status_set.status','total_klaim'])
                ->make(true);
        }
    }

    public function confirm_klaim(Request $request)
    {
        if (!empty($request->id)) {
            try {
                DB::beginTransaction();
                $data = KlaimAsuransi::with('polis','member','status_set')->find($request->id);
                view()->share('data',['data'=>$data]);
                $pdf = PDF::loadView('template.klaim-asuransi', ['data'=>$data]);
                $date = Str::remove('-', strval(Carbon::now()->format('Y-m-d')));
                $pdf_file = $pdf->download()->getOriginalContent();
                $member = Str::slug($data->member->nama_lengkap,'-');
                $path = strval('public/klaim-asuransi/'.$member.'/MYPETT_CLAIM_'.$date.'_'.strval(md5($data->id)).'.pdf');
                Storage::put($path, $pdf_file);
                if (Storage::exists($path)) {
                    KlaimAsuransi::where('id',$request->id)->update([
                        'status_klaim'=>3,
                        'path'=>$path
                    ]);
                }
                Helper::createUserLog("Berhasil konfirmasi klaim untuk member ".$data->member->nama_lengkap, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil membuat nota klaim'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal konfirmasi klaim", auth()->user()->id, $this->title);
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

    public function reject_klaim(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'alasan' => 'required',
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
                $data = KlaimAsuransi::find($request->id);
                TolakKlaimAsuransi::create([
                    'klaim_id'=>$data->id,
                    'alasan_menolak'=>$request->alasan
                ]);
                $data->update(['status_klaim'=>2]);
                Helper::createUserLog("Berhasil konfirmasi klaim untuk member ".$data->member->nama_lengkap, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menolak klaim'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menolak klaim", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }
}
