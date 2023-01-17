<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PaketContent;
use App\Models\ProdukAsuransi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $faq = Faq::latest()->limit(5)->get();
        $package = PaketContent::latest()->limit(3)->get();
        return view('landing.home', [
            'title'=>'Home',
            'faqs'=>$faq,
            'packages'=>$package
        ]);
    }

    public function paket()
    {
        $paket = ProdukAsuransi::latest()->get();
        return view('landing.paket', [
            'title'=>'Paket Asuransi',
            'pakets'=>$paket
        ]);
    }

    public function faqs()
    {
        $faq = Faq::latest()->get();
        return view('landing.faqs', [
            'title'=>'FAQs',
            'faqs'=>$faq
        ]);
    }
}
