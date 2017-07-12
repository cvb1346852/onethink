<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/11,0011
 * Time: 22:09
 */

namespace Home\Controller;


use Wechat\Controller\WechatController;
use EasyWeChat\Foundation\Application;

class WxController extends WechatController
{
    public function index(){
        include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件
        $options = [
            'debug'  => true,
            'app_id' => 'wxcbe68d7ded49482c',
            'secret' => 'you-a798d9d0a5ad9abadb403834e10040bf',
            'token'  => 'it',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
            //...
        ];
        $app = new Application($options);
        $response = $app->server->serve();
// 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
    }
}