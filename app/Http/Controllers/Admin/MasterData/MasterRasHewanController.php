<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use Illuminate\Http\Request;
use App\Models\MasterRasHewan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisHewan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterRasHewanController extends Controller
{
    public $title = 'Master Ras Hewan';

    public function index()
    {
        $jenisHewan = MasterJenisHewan::all();
        return view('admin.master-data.master-ras-hewan',[
            'title' => $this->title,
            'jenis_hewans'=>$jenisHewan
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterRasHewan::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->editColumn('jenis_hewan_id.nama', function($row){
                    return $row->jenis_hewan->nama;
                })
                ->editColumn('harga_hewan', function($row){
                    return 'Rp '.number_format($row->harga_hewan,0,"",".");
                })
                ->editColumn('persen_per_umur', function($row){
                    return $row->persen_per_umur.' %';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:master_ras_hewan,nama_ras',
            'persen' => 'required|numeric',
            'harga_hewan' => 'required|numeric',
            'jenis_hewan' => 'required|',
            'deskripsi' => 'nullable',
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
                $ras = MasterRasHewan::create([
                    'nama_ras' => $request->nama,
                    'jenis_hewan_id' => $request->jenis_hewan,
                    'harga_hewan' => $request->harga_hewan,
                    'persen_per_umur' => $request->persen,
                    'deskripsi' => $request->deskripsi
                ]);
                Helper::createUserLog("Berhasil menambahkan ras hewan ".$request->nama, auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah ras hewan", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function edit($id)
    {
        $data = MasterRasHewan::find($id);
        $jenis = MasterJenisHewan::all();
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
                'jeniss' => $jenis
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
            'persen' => 'required|numeric',
            'harga_hewan' => 'required|numeric',
            'jenis_hewan' => 'required',
            'deskripsi' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $data = MasterRasHewan::find($id);
                if ($data->nama_ras==$request->nama) {
                    $data->update([
                        'nama_ras' => $request->nama,
                        'jenis_hewan_id' => $request->jenis_hewan,
                        'harga_hewan' => $request->harga_hewan,
                        'persen_per_umur' => $request->persen,
                        'deskripsi' => $request->deskripsi
                    ]);
                    Helper::createUserLog("Berhasil mengubah ras hewan", auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = MasterRasHewan::where(function($q)use($request){
                            $q->where('nama_ras','=',$request->nama)->where('jenis_hewan_id','=',$request->jenis_hewan);
                        })->whereNot('id',$id)->first();
                    if ($cek) {
                        return response()->json([
                            'message'=>'Nama ras sudah digunakan!'
                        ],404);
                    } else {
                        $data->update([
                            'nama_ras' => $request->nama,
                            'jenis_hewan_id' => $request->jenis_hewan,
                            'harga_hewan' => $request->harga_hewan,
                            'persen_per_umur' => $request->persen,
                            'deskripsi' => $request->deskripsi
                        ]);
                        Helper::createUserLog("Berhasil mengubah ras hewan ", auth()->user()->id, $this->title);
                        DB::commit();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Berhasil mengubah data'
                        ]);
                    }
                }
            } catch (Exception $e) {
                Helper::createUserLog("Gagal mengubah data ras hewan", auth()->user()->id, $this->title);
                return response()->json([
                    'status'=>422,
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function destroy($id)
    {
        $data = MasterRasHewan::find($id);
        if ($data) {
            Helper::createUserLog("Berhasil menghapus ras hewan ".$data->nama, auth()->user()->id, $this->title);
            $data->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Berhasil menghapus data'
            ]);
        } else {
            Helper::createUserLog("Gagal menghapus data ras hewan", auth()->user()->id, $this->title);
            return response()->json([
                'status'=>422,
                'message'=>'Gagal menghapus'
            ],422);
        }
    }
}
