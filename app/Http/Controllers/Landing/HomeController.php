<?php

namespace App\Http\Controllers\Landing;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
