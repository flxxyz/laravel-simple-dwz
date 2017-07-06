<?php
/**
 * Created by PhpStorm.
 * User: fff
 * Date: 2017/7/5
 * Time: 18:53
 */

namespace App;


class Util
{
    /**
     * 客户端IP获取
     *
     * @return array|false|string
     */
    public static function getClientIP()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                    $ip = getenv("REMOTE_ADDR");
                else
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                        $ip = $_SERVER['REMOTE_ADDR'];
                    else
                        $ip = '';
        return ($ip);
    }

    public static function getHost() {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

    public function gethttp($uri)
    {
        $curl = new Curl();
        $curl->get($uri);

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            //echo 'Response:' . "\n";
            return $curl->response;
        }
    }
}