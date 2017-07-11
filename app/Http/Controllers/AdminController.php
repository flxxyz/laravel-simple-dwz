<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $this->check();
    }

    private function check() {
        if(!is_null(session('user', null))) {
            return '成功登陆';
        }else {
            return redirect('/hentai/login');
        }
    }
}
