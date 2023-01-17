<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use App\Models\MasterBank;
use Illuminate\Http\Request;
use App\Models\NomorRekeningBank;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NoRekController extends Controller
{
    public $title = 'Master Nomor Rekening';

    public function index()
    {
        $data = MasterBank::all();
        return view('admin.master-data.master-no-rekening',[
            'title' => $this->title,
            'datas' => $data
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = NomorRekeningBank::with('master_bank')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->editColumn('master_bank.nama', function($row){
                    return $row->master_bank->nama;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'nomor_rekening' => 'required|unique:nomor_rekening_bank_payment,nomor_rekening',
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
                $rek = NomorRekeningBank::create([
                    'bank_id' => $request->bank,
                    'nomor_rekening' => $request->nomor_rekening,
                ]);
                Helper::createUserLog("Berhasil menambahkan nomor rekening bank ".$rek->master_bank->nama, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data rekening'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah nomor rekening bank", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function edit($id)
    {
        $data = NomorRekeningBank::find($id);
        $bank = MasterBank::all();
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
                'banks' => $bank
            ]);
        } else {
            return response()->json([
                'message'=>'Data tidak ditemukan!'
            ],422);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'nomor_rekening' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $data = NomorRekeningBank::find($id);
                if ($data->nomor_rekening==$request->nomor_rekening) {
                    $data->update([
                        'bank_id'=>$request->bank,
                        'nomor_rekening'=>$request->nomor_rekening
                    ]);
                    Helper::createUserLog("Berhasil mengubah nomor rekening bank", auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = NomorRekeningBank::where('nomor_rekening',$request->nomor_rekening)->whereNot('id',$id)->first();
                    if ($cek) {
                        return response()->json([
                            'message'=>'Nomor rekening sudah digunakan!'
                        ],404);
                    } else {
                        $data->update([
                            'bank_id'=>$request->bank,
                            'nomor_rekening'=>$request->nomor_rekening
                        ]);
                        Helper::createUserLog("Berhasil mengubah nomor rekening bank ", auth()->user()->id, $this->title);
                        DB::commit();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Berhasil mengubah data'
                        ]);
                    }
                }
            } catch (Exception $e) {
                Helper::createUserLog("Gagal mengubah data bank", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function destroy($id)
    {
        $data = NomorRekeningBank::find($id);
        if ($data) {
            Helper::createUserLog("Berhasil menghapus nomor rekening bank ".$data->master_bank->nama, auth()->user()->id, $this->title);
            $data->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Berhasil menghapus data'
            ]);
        } else {
            Helper::createUserLog("Gagal menghapus data bank", auth()->user()->id, $this->title);
            return response()->json([
                'message'=>'Gagal menghapus'
            ],422);
        }
    }
}
