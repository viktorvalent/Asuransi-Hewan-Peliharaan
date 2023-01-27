<?php

namespace App;

use Illuminate\Support\Str;

class Helper {
    public static function createUserLog($a,$b,$c)
    {
        $log['description'] = $a;
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		$log['ip_address'] = $ipaddress;
		$log['user_id'] = $b;
		$log['menu'] = $c;

		\App\Models\UserLog::create($log);
    }

    public static function generatePolisNumber()
    {
        $inv['tanggal_dibuat'] = \Carbon\Carbon::now()->format('Y-m-d');
        $getLast = \App\Models\PolisNumber::latest()->first();
        if (!$getLast) {
            $inv['nomor'] = 1;
        } else {
            $inv['nomor'] = $getLast->nomor + 1;
        }
        \App\Models\PolisNumber::create($inv);
        $polis_number = strval(Str::padLeft($inv['nomor'], 8, '0'));
        return $polis_number;
    }

    public static function chartData()
    {
        $jan = \App\Models\PembelianProduk::whereMonth('created_at', '01')->whereYear('created_at', date('Y'))->count();
        $feb = \App\Models\PembelianProduk::whereMonth('created_at', '02')->whereYear('created_at', date('Y'))->count();
        $mar = \App\Models\PembelianProduk::whereMonth('created_at', '03')->whereYear('created_at', date('Y'))->count();
        $apr = \App\Models\PembelianProduk::whereMonth('created_at', '04')->whereYear('created_at', date('Y'))->count();
        $mei = \App\Models\PembelianProduk::whereMonth('created_at', '05')->whereYear('created_at', date('Y'))->count();
        $jun = \App\Models\PembelianProduk::whereMonth('created_at', '06')->whereYear('created_at', date('Y'))->count();
        $jul = \App\Models\PembelianProduk::whereMonth('created_at', '07')->whereYear('created_at', date('Y'))->count();
        $ags = \App\Models\PembelianProduk::whereMonth('created_at', '08')->whereYear('created_at', date('Y'))->count();
        $sep = \App\Models\PembelianProduk::whereMonth('created_at', '09')->whereYear('created_at', date('Y'))->count();
        $okt = \App\Models\PembelianProduk::whereMonth('created_at', '10')->whereYear('created_at', date('Y'))->count();
        $nov = \App\Models\PembelianProduk::whereMonth('created_at', '11')->whereYear('created_at', date('Y'))->count();
        $des = \App\Models\PembelianProduk::whereMonth('created_at', '12')->whereYear('created_at', date('Y'))->count();
        $chart = [$jan,$feb,$mar,$apr,$mei,$jun,$jul,$ags,$sep,$okt,$nov,$des];

        return $chart;
    }

    public static function getPersenByWeek($model)
    {
        $result['status'] = true;
        $thisWeek = ($model::whereBetween('created_at',[\Carbon\Carbon::now()->startOfWeek(),\Carbon\Carbon::now()->endOfWeek()])->count())==0?1:($model::whereBetween('created_at',[\Carbon\Carbon::now()->startOfWeek(),\Carbon\Carbon::now()->endOfWeek()])->count());
        $lastWeek = ($model::whereBetween('created_at',[\Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->dayOfWeek)->startOfWeek(),\Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->dayOfWeek)->endOfWeek()])->count())==0?1:($model::whereBetween('created_at',[\Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->dayOfWeek)->startOfWeek(),\Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->dayOfWeek)->endOfWeek()])->count());
        $result['persen'] = ($thisWeek / $lastWeek) * 100;

        if ($thisWeek < $lastWeek) {
            $result['status'] = false;
        }

        return $result;
    }

}
