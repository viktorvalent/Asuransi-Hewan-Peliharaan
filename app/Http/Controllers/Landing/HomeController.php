<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\ProdukAsuransi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faq = Faq::latest()->limit(5)->get();
        return view('landing.home', [
            'title'=>'Home',
            'faqs'=>$faq
        ]);
    }

    public function paket()
    {
        $paket = ProdukAsuransi::all();
        return view('landing.paket', [
            'title'=>'Paket Asuransi',
            'pakets'=>$paket
        ]);
    }
}
