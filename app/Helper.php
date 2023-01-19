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

}
