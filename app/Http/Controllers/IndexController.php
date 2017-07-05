<?php

namespace App\Http\Controllers;

use App\Link;
use App\Util;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $link = Link::all();
        //dd($link);
        return view('home.index', [
            'data' => $link
        ]);
    }

    /**
     * @param $param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uri($param)
    {

        return view('home.detail', [
            'id' => $param
        ]);
    }

    public function produce(Request $request) {
        $response = [
            'data' => [
                'uesr' => '',
                'uri' => '',
                'create_at' => ''
            ],
            'success' => 0,
            'message' => ''
        ];

        if($request->isMethod('POST')) {
            $uri = $request->get('uri');
            $hash = base_convert(abs(crc32($uri)), 10, 32);
            $ip = Util::getClientIP();

            $data['hash'] = $hash;
            $data['uri'] = $uri;
            $data['ip'] = $ip;

            if ($row = Link::create($data)) {
                //echo $row;
                $response['uri'] = Util::getHost() . $row->hash;
                $response['success'] = 1;
                $response['data']['create_at'] = $row->created_at;
                //Session::flash('success', '添加成功');
                return response()->json($response);
            } else {
                $response['uri'] = Util::getHost();
                $response['message'] = Util::getHost();
                return response()->json($response);
            }
        }else {
            $response['uri'] = Util::getHost();
            return response()->json($response);
        }
    }
}
