<?php

namespace App\Http\Controllers;

use App\TopNew;
use Illuminate\Http\Request;

use App\Util;
use App\Link;

class TopController extends Controller
{
    public function new()
    {
        //return '最新生成短链接';
        $new = TopNew::orderBy('id', 'desc')->take(10)->get();
        return view('top.new', ['data' => $new]);
    }

    public function click()
    {
        //return '点击最多排行';
        return view('top.click');
    }

    public function show()
    {
        //return '显示最多排行';
        return view('top.show');
    }
}
