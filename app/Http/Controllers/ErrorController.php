<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function detail()
    {
        return view('error.detail');
    }
}
