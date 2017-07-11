<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function login()
    {
        return '登录页面';
    }

    public function logout()
    {
        $this->check('成功注销');
        return '非法访问';
    }

    public function jump()
    {
        $this->check(redirect('/hentai/index'));
        return '非法访问';
    }

    private function check($message)
    {
        if(!is_null(session('user', null))) {
            return $message;
        }
    }
}
