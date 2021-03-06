<?php

namespace App\Http\Controllers;

use App\TopNew;
use Illuminate\Http\Request;

use App\Util;
use App\Link;
use App\Show;
use Yangqi\Htmldom\Htmldom;

class ApiController extends Controller
{
    /**
     * 生成短网址
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function produce(Request $request)
    {
        // 构造回调json
        $response = $this->JSON();

        if ($request->isMethod('POST')) {
            $uri = $request->get('uri');
            $hash = base_convert(abs(crc32($uri)), 10, 32);
            $ip = Util::getClientIP();

            // 存在hash返回已有hash信息
            $link = Link::where('hash', $hash)->get();
            if (count($link) != 0) {
                Show::find($link[0]->id)->increment('produce');  // 创建+1
                $response['statu'] = 200;
                $response['message'] = 'hash exist';
                $response['type'] = 'produce';
                $response['result']['count'] = 1;
                $response['result']['data']['created_at'] = $link[0]->created_at;
                $response['result']['data']['uri'] = Util::getHost() . $hash;
                return response()->json($response);
            }

            $data['hash'] = $hash;
            $data['uri'] = $uri;
            $data['ip'] = $ip;

            // 创建新hash
            if ($row = Link::create($data)) {
                //dd($row);
                $show = new Show();
                if ($id = $show->insertGetId(['link_id' => $row->id])) {
                    $show->where('id', $id)->increment('produce');
                }

                $uri = $row->uri;
                $hash = Util::getHost() . $row->hash;
                ob_start();
                $html = Util::getHttp($uri);
                ob_end_clean();
                $htmlDom = new Htmldom();
                $htmlDom->load($html);
                $title = $htmlDom->find('title', 0)->innertext;

                if (empty($title)) {
                    $title = $hash;
                }

                // 添加至最新排行表
                $data = ['link_id' => $row->id, 'title' => $title];
                TopNew::create($data);
                $response['statu'] = 200;
                $response['message'] = 'success';
                $response['type'] = 'produce';
                $response['result']['count'] = 1;
                $response['result']['data']['uri'] = $hash;
                $response['result']['data']['created_at'] = $row->created_at;
                return response()->json($response);
            } else {
                $response['result']['data']['uri'] = Util::getHost();
                $response['message'] = 'error';
                return response()->json($response);
            }
        } else {
            $response['result']['data']['uri'] = Util::getHost();
            return response()->json($response);
        }
    }

    /**
     * Top的最新
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function new()
    {
        $data = $this->JSON();

        $topNew = TopNew::orderBy('id', 'desc')->take(10)->get();
        $count = count($topNew);

        if ($count != 0) {
            foreach ($topNew as $key => $item) {
                $title = $item->title;

                $data['result']['data'][] = [
                    'created_at' => $item->created_at->toDateTimeString(),
                    'title' => $title,
                    'uri' => Util::getHost() . Link::find($item->link_id)->hash
                ];
            }
            $data['type'] = 'new';
            $data['statu'] = 200;
            $data['result']['count'] = $count;
            $data['message'] = 'Query Success';
            return response()->json($data);
        } else {
            $data['message'] = '暂时没有短链接...';
            return response()->json($data);
        }
    }

    public function click()
    {
        $data = $this->JSON();

        $show = Show::orderBy('click', 'desc')->take(10)->get();
        $count = count($show);

        if ($count != 0) {
            foreach ($show as $key => $item) {
                $data['result']['data'][] = [
                    'created_at' => $item->created_at->toDateTimeString(),
                    'title' => TopNew::find($item->link_id)['title'],
                    'uri' => Util::getHost() . Link::find($item->link_id)->hash,
                    'num' => $item->click
                ];
            }
            $data['type'] = 'click';
            $data['statu'] = 200;
            $data['result']['count'] = $count;
            $data['message'] = 'Query Success';
            return response()->json($data);
        } else {
            $data['message'] = '暂时没有短链接...';
            return response()->json($data);
        }
    }

    public function show()
    {
        $data = $this->JSON();

        $show = Show::orderBy('show', 'desc')->take(10)->get();
        $count = count($show);

        if ($count != 0) {
            foreach ($show as $key => $item) {
                $data['result']['data'][] = [
                    'created_at' => $item->created_at->toDateTimeString(),
                    'title' => TopNew::find($item->link_id)['title'],
                    'uri' => Util::getHost() . Link::find($item->link_id)->hash,
                    'num' => $item->show
                ];
            }
            $data['type'] = 'show';
            $data['statu'] = 200;
            $data['result']['count'] = $count;
            $data['message'] = 'Query Success';
            return response()->json($data);
        } else {
            $data['message'] = '暂时没有短链接...';
            return response()->json($data);
        }
    }

    /**
     * Top的JSON结构
     *
     * @return array
     */
    private function JSON() {
        return [
            'message' => '',
            'statu' => 100,
            'type' => '',
            'result' => [
                'user' => '',
                'count' => 0,
                'query_time' => time(),
                'data' => []
            ]
        ];
    }
}
