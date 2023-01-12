<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserChecker {
    public function isLogin()
    {
        $status = false;

        if (!Auth::check()) {
            $status = true;
        }

        return $status;
    }
}
