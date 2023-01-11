<?php

namespace App\Http\Controllers\Admin\MasterData;

use Illuminate\Http\Request;
use App\Models\NomorRekeningBank;
use App\Http\Controllers\Controller;
use App\Models\MasterBank;
use Yajra\DataTables\Facades\DataTables;

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
                    $action = '<button data-id="'.$row->id.'" class="btn btn-primary btn-sm my-1">Edit</button>
                                <button data-id="'.$row->id.'" class="btn btn-danger btn-sm">Hapus</button>';
                    return $action;
                })
                ->editColumn('master_bank.nama', function($row){
                    return $row->master_bank->nama;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
