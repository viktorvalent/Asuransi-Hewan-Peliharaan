<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use Illuminate\Http\Request;
use App\Models\MasterJenisHewan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterJenisHewanController extends Controller
{
    public $title = 'Master Jenis Hewan';

    public function index()
    {
        return view('admin.master-data.master-jenis-hewan',[
            'title' => $this->title,
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterJenisHewan::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:master_jenis_hewan',
            'deskripsi' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $jenis = MasterJenisHewan::create([
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                ]);
                Helper::createUserLog("Berhasil menambahkan jenis hewan ".$jenis->nama, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah jenis hewan", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function edit($id)
    {
        $data = MasterJenisHewan::find($id);
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
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
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $data = MasterJenisHewan::find($id);
                if ($data->nama==$request->nama) {
                    $data->update([
                        'nama' => $request->nama,
                        'deskripsi' => $request->deskripsi,
                    ]);
                    Helper::createUserLog("Berhasil mengubah jenis hewan", auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = MasterJenisHewan::where('nama',$request->nama)->whereNot('id',$id)->first();
                    if ($cek) {
                        return response()->json([
                            'message'=>'Nama sudah digunakan!'
                        ],404);
                    } else {
                        $data->update([
                            'nama' => $request->nama,
                            'deskripsi' => $request->deskripsi,
                        ]);
                        Helper::createUserLog("Berhasil mengubah jenis hewan ", auth()->user()->id, $this->title);
                        DB::commit();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Berhasil mengubah data'
                        ]);
                    }
                }
            } catch (Exception $e) {
                Helper::createUserLog("Gagal mengubah data jenis hewan", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function destroy($id)
    {
        $data = MasterJenisHewan::find($id);
        if ($data) {
            Helper::createUserLog("Berhasil menghapus jenis hewan ".$data->nama, auth()->user()->id, $this->title);
            $data->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Berhasil menghapus data'
            ]);
        } else {
            Helper::createUserLog("Gagal menghapus data jenis hewan", auth()->user()->id, $this->title);
            return response()->json([
                'message'=>'Gagal menghapus'
            ],422);
        }
    }
}
