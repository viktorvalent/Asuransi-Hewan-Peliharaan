<?php

namespace App\Http\Controllers\Admin\MasterData;

use Exception;
use App\Helper;
use App\Models\MasterBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterBankController extends Controller
{
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
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm">Hapus</button>';
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
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                $logo = $request->file('logo')->store('public/master-data/bank-logo/');
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
}
