<?php

namespace App\Http\Controllers;

use App\Link;
use App\Show;
use App\Util;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['sc'] = Link::count();
        $data['dj'] = Show::pluck('click')->sum();
        $data['ck'] = Show::pluck('show')->sum();
        //dd($data);
        return view('home.index', [
            'data' => $data
        ]);
    }

    /**
     * 短网址跳转操作
     *
     * @param $param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uri($param)
    {
        $link = Link::where('hash', $param)->get();
        if(count($link) != 0) {
            $show = Show::find($link[0]->id);
            $show->increment('click');  // 点击+1

            $uri = $link[0]->uri;
            //dd(Util::isAccess($uri));

            if(Util::isAccess($uri)) {
                $show->increment('show');  // 点击+1
                return redirect('/')->setTargetUrl($uri);
            }else {
                // 可以预设友好页面，提示用户当前网址无法访问
                return redirect('/')->setTargetUrl($uri);
            }
        }

        return view('error.404');
    }

}
