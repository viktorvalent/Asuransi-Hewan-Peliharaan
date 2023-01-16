<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\MemberController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebContent\FaqController;
use App\Http\Controllers\Admin\WebContent\HeroController;
use App\Http\Controllers\Admin\MasterData\NoRekController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Admin\MasterData\MasterBankController;
use App\Http\Controllers\Admin\MasterData\MasterRasHewanController;
use App\Http\Controllers\Admin\MasterData\MasterJenisHewanController;
use App\Http\Controllers\Admin\MasterData\ProdukAsuransiController;
use App\Http\Controllers\Admin\WebContent\TermAndConditionsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/paket-asuransi', [HomeController::class, 'paket'])->name('home.package');

// Login Admin
Route::controller(AdminController::class)->prefix('/auth')->group(function(){
    Route::get('/sign-in','index')->name('sign-in.admin');
    Route::post('/authenticating','authenticate')->name('authenticating.admin');
    Route::get('/sign-out','logout')->name('sign-out.admin');
});

// Login dan register member
Route::controller(MemberController::class)->prefix('/member')->group(function(){
    Route::get('/sign-in','index')->name('sign-in.member');
    Route::post('/authenticating','authenticate')->name('authenticating.member');
    Route::post('/registration','registration')->name('register.member');
    Route::get('/sign-out','logout')->name('sign-out.member');
});

Route::middleware(['auth','is_admin'])->group(function(){
    Route::controller(DashboardController::class)->prefix('/auth/dashboard')->group(function(){
        Route::get('/','index')->name('auth.dashboard');
    });

    Route::controller(MasterBankController::class)->prefix('/auth/dashboard/master-bank')->group(function(){
        Route::get('/','index')->name('master-data.bank');
        Route::get('/list-data','data')->name('master-bank.data');
        Route::post('/create','store')->name('master-data.bank.create');
        Route::get('/edit/{id}','edit');
        Route::post('/update','update')->name('master-data.bank.update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(NoRekController::class)->prefix('/auth/dashboard/master-nomor-rekening')->group(function(){
        Route::get('/','index')->name('master-data.no-rek');
        Route::get('/list-data','data')->name('no-rek.data');
        Route::post('/create','store')->name('master-data.no-rek.create');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(MasterJenisHewanController::class)->prefix('/auth/dashboard/master-jenis-hewan')->group(function(){
        Route::get('/','index')->name('master-data.jenis-hewan');
        Route::get('/list-data','data')->name('jenis-hewan.data');
        Route::post('/create','store')->name('master-data.jenis-hewan.create');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(MasterRasHewanController::class)->prefix('/auth/dashboard/master-ras-hewan')->group(function(){
        Route::get('/','index')->name('master-data.ras-hewan');
        Route::get('/list-data','data')->name('ras-hewan.data');
        Route::post('/create','store')->name('master-data.ras-hewan.create');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(ProdukAsuransiController::class)->prefix('/auth/dashboard/produk-asuransi')->group(function(){
        Route::get('/','index')->name('master-data.produk-asuransi');
        Route::get('/tambah','addProduk')->name('master-data.add-produk');
        Route::get('/list-data','data')->name('produk-asuransi.data');
        Route::post('/create','store')->name('master-data.produk-asuransi.create');
        Route::get('/detail/{id}','detail')->name('master-data.produk-asuransi.detail');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(FaqController::class)->prefix('/auth/dashboard/faq')->group(function(){
        Route::get('/','index')->name('web-content.faq');
        Route::get('/list-data','data')->name('faq.data');
        Route::post('/create','store')->name('web-content.faq.create');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
        Route::get('/delete/{id}','destroy');
    });

    Route::controller(TermAndConditionsController::class)->prefix('/auth/dashboard/tnc')->group(function(){
        Route::get('/','index')->name('web-content.tnc');
        Route::get('/list-data','data')->name('tnc.data');
        Route::post('/create','update')->name('web-content.tnc.updateOrCreate');
        Route::get('/edit/{id}','edit');
    });

    Route::controller(HeroController::class)->prefix('/auth/dashboard/hero')->group(function(){
        Route::get('/','index')->name('web-content.hero');
        Route::get('/list-data','data')->name('hero.data');
        Route::get('/edit/{id}','edit');
        Route::put('/update/{id}','update');
    });
});

Route::middleware(['auth','is_member'])->group(function(){
    Route::controller(MemberDashboardController::class)->prefix('/member')->group(function(){
        Route::get('/profile', 'index')->name('member.dashboard');
        Route::get('/my-insurance', 'my_insurance')->name('member.my-insurance');
        Route::post('/add-member-data', 'store_member')->name('member.create');
    });
});
