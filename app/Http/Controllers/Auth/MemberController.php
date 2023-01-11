<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('membership.login',['title'=>'Sign In | Mypett Insurance']);
    }
}
