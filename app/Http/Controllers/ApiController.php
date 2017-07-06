<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Util;
use App\Link;
use App\Show;

class ApiController extends Controller
{
    /**
     * 生成短网址
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function produce(Request $request) {
        // 构造回调json
        $response = [
            'data' => [
                'uesr' => '',
                'uri' => '',
                'created_at' => ''
            ],
            'statu' => 100,
            'message' => ''
        ];

        if($request->isMethod('POST')) {
            $uri = $request->get('uri');
            $hash = base_convert(abs(crc32($uri)), 10, 32);
            $ip = Util::getClientIP();

            // 存在hash返回已有hash信息
            $link = Link::where('hash', $hash)->get();
            if(count($link) != 0) {
                Show::find($link[0]->id)->increment('produce');  // 创建+1
                $response['statu'] = 200;
                $response['message'] = 'hash exist';
                $response['data']['created_at'] = $link[0]->created_at;
                $response['data']['uri'] = Util::getHost() . $hash;
                return response()->json($response);
            }

            $data['hash'] = $hash;
            $data['uri'] = $uri;
            $data['ip'] = $ip;

            // 创建新hash
            if ($row = Link::create($data)) {
                //dd($row);
                $show = new Show();
                if($id = $show->insertGetId(['link_id' => $row->id])) {
                    $show->where('id', $id)->increment('produce');
                }
                $response['data']['uri'] = Util::getHost() . $row->hash;
                $response['statu'] = 200;
                $response['message'] = 'success';
                $response['data']['created_at'] = $row->created_at;
                return response()->json($response);
            } else {
                $response['data']['uri'] = Util::getHost();
                $response['message'] = 'error';
                return response()->json($response);
            }
        }else {
            $response['data']['uri'] = Util::getHost();
            return response()->json($response);
        }
    }
}
