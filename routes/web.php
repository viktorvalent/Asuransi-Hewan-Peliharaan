<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MasterData\MasterBankController;
use App\Http\Controllers\Admin\MasterData\NoRekController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\MemberController;
use App\Http\Controllers\Landing\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::middleware('auth')->group(function(){
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
});
