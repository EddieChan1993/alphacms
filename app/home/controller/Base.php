<?php
namespace app\home\controller;

use app\common\controller\BaseController;
use think\Db;
use think\Exception;
use think\Request;

class Base  extends BaseController
{
    function __construct()
    {
        $request = Request::instance();
        if ($request->method() != "POST") {
            throw new Exception("非法请求");
        }
        $is_close = Db::name('options')->where('option_id', 6)->value('is_close');
        if (empty($is_close)) {
            $map = [
                'code'=>4001,
                'error'=>0,
                'msg'=>"系统维护中..."
            ];
            echo json_encode($map);
            die;
        }
    }

    /**
     * 正常消息输出
     * @param $msg
     */
    public  function output($msg)
    {
        $map = [
            'code'=>200,
            'error'=>0,
            'msg'=>$msg
        ];

        echo json_encode($map);
        die;
    }

    /**
     * 提醒消息输出
     * @param $msg
     */
    public  function warning($msg)
    {
        $map = [
            'code'=>200,
            'error'=>1,
            'msg'=>$msg
        ];

        echo json_encode($map);
        die;
    }
}