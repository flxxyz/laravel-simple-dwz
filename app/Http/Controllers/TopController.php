<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Util;
use App\Link;

class TopController extends Controller
{
    public function new()
    {
        return '最新生成短链接';

    }

    public function click()
    {
        return '点击最多排行';
    }

    public function show()
    {
        return '显示最多排行';
    }
}
