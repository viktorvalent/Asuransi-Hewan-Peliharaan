<?php

namespace App\Http\Controllers\Admin\WebContent;

use Exception;
use App\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TermAndConditions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TermAndConditionsController extends Controller
{
    public $title = 'Term & Conditions';

    public function index()
    {
        return view('admin.web-content.term-and-conditions', [
            'title'=>$this->title
        ]);
    }

    public function edit($id)
    {
        $data = TermAndConditions::find($id);
        return view('admin.web-content.add-term-and-conditions', [
            'title'=>$this->title,
            'data'=>$data
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = TermAndConditions::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<button type="button" data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1 edit">Edit</button>';
                    return $action;
                })
                ->editColumn('isi', function($row){
                    return Str::limit(strip_tags($row->isi),100);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi' => 'required',
        ],[
            'isi.required'=>'Term & condition tidak boleh kosong!'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            try {
                DB::beginTransaction();
                TermAndConditions::where('id','=',$request->id)->update([
                    'isi' => $request->isi,
                ]);
                Helper::createUserLog("Berhasil menambahkan Term & Conditions", auth()->user()->id, $this->title);
                DB::commit();
                return response()->json([
                    'status'=>200,
                    'message'=>'Berhasil menambahkan data'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Helper::createUserLog("Gagal menambah Term & Conditions", auth()->user()->id, $this->title);
                return response()->json([
                    'message'=>$e->getMessage()
                ],422);
            }
        }
    }
}
