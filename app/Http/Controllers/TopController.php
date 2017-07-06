<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function produce()
    {
        return '生成新排行';
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
