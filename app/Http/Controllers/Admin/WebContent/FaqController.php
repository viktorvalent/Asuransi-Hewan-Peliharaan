<?php

namespace App\Http\Controllers\Admin\WebContent;

use Exception;
use App\Helper;
use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public $title = 'FAQ';

    public function index()
    {
        return view('admin.web-content.faq',[
            'title' => $this->title
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button type="button" data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>
                                <button type="button" data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Hapus</button>';
                    return $action;
                })
                ->editColumn('jawaban', function($row){
                    return Str::limit($row->jawaban,30);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|unique:faq',
            'jawaban' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                Faq::create([
                    'pertanyaan' => $request->pertanyaan,
                    'jawaban' => $request->jawaban
                ]);
                Helper::createUserLog("Berhasil menambahkan FAQ", auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah FAQ", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function edit($id)
    {
        $data = Faq::find($id);
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $data = Faq::find($request->id);
                if ($data->pertanyaan==$request->pertanyaan) {
                    $data->update([
                        'pertanyaan' => $request->pertanyaan,
                        'jawaban' => $request->jawaban
                    ]);
                    Helper::createUserLog("Berhasil mengubah FAQ", auth()->user()->id, $this->title);
                    DB::commit();
                    return response()->json([
                        'status'=>200,
                        'message'=>'Berhasil mengubah data'
                    ]);
                } else {
                    $cek = Faq::where('pertanyaan',$request->pertanyaan)->whereNot('id',$request->id)->first();
                    if ($cek) {
                        return response()->json([
                            'message'=>'Pertanyaan sudah digunakan!'
                        ],404);
                    } else {
                        $data->update([
                            'pertanyaan' => $request->pertanyaan,
                            'jawaban' => $request->jawaban
                        ]);
                        Helper::createUserLog("Berhasil mengubah FAQ", auth()->user()->id, $this->title);
                        DB::commit();
                        return response()->json([
                            'status'=>200,
                            'message'=>'Berhasil mengubah data'
                        ]);
                    }
                }
            } catch (Exception $e) {
                Helper::createUserLog("Gagal mengubah FAQ", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }

    public function destroy($id)
    {
        $data = Faq::find($id);
        try {
            Helper::createUserLog("Berhasil menghapus FAQ", auth()->user()->id, $this->title);
            $data->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Berhasil menghapus data'
            ]);
        } catch (Exception $e) {
            Helper::createUserLog("Gagal menghapus FAQ", auth()->user()->id, $this->title);
            return response()->json([
                'message'=>$e->getMessage()
            ],422);
        }
    }
}
