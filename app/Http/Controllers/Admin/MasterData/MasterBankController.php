<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use App\Models\MasterBank;
use App\Traits\UserChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterBankController extends Controller
{
    use UserChecker;
    public $title = 'Master Bank';

    public function index()
    {
        return view('admin.master-data.master-bank',[
            'title' => $this->title
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterBank::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button type="button" data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->editColumn('logo', function ($row){
                    $path = asset(Storage::url($row->logo));
                    return '<img src="'.$path.'" width="100" />';
                })
                ->rawColumns(['action','logo'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048'
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
                $logo = $request->file('logo')->store('public/master-data/bank-logo');
                MasterBank::create([
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'logo' => $logo
                ]);
                Helper::createUserLog("Berhasil menambahkan data bank ".$request->nama, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah data bank", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function edit($id)
    {
        $data = MasterBank::find($id);
        if ($data) {
            if (Storage::exists($data->logo)) {
                $data->logo = asset(Storage::url($data->logo));
                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            }
        } else {
            return response()->json([
                'message'=>'Data tidak ditemukan!'
            ],422);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'logo' => 'nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $data = MasterBank::find($request->id);
                $nama_bank = $data->nama;
                $logo_path = $data->logo;

                if ($nama_bank==$request->nama) {
                    if($request->hasFile('logo')){
                        if(Storage::exists($data->logo)){
                            Storage::delete($data->logo);
                            $logo_path = $request->file('logo')->store('public/master-data/bank-logo');
                        }
                    }

                    $data->update([
                        'nama'=>$request->nama,
                        'deskripsi'=>$request->deskripsi,
                        'logo'=>$logo_path
                    ]);

                    Helper::createUserLog("Berhasil mengubah data bank ".$nama_bank, auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = MasterBank::where('nama',$request->nama)->whereNot('id',$request->id)->first();

                    if ($cek) {
                        return response()->json([
                            'message'=>'Nama sudah digunakan!'
                        ],404);
                    } else {
                        if($request->hasFile('logo')){
                            if(Storage::exists($data->logo)){
                                Storage::delete($data->logo);
                                $logo_path = $request->file('logo')->store('public/master-data/bank-logo');
                            }
                        }

                        $data->update([
                            'nama'=>$request->nama,
                            'deskripsi'=>$request->deskripsi,
                            'logo'=>$logo_path
                        ]);

                        Helper::createUserLog("Berhasil mengubah data bank ".$nama_bank, auth()->user()->id, $this->title);
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
        $data = MasterBank::find($id);
        try {
            if (Storage::exists($data->logo)) {
                Storage::delete($data->logo);
            }
            Helper::createUserLog("Berhasil menghapus data bank ".$data->nama, auth()->user()->id, $this->title);
            $data->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Berhasil menghapus data'
            ]);
        } catch (Exception $e) {
            Helper::createUserLog("Gagal menghapus data bank", auth()->user()->id, $this->title);
            return response()->json([
                'message'=>$e->getMessage()
            ],422);
        }
    }
}
