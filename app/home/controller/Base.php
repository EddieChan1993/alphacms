<?php
namespace app\home\controller;

use app\common\controller\BaseController;
use think\Db;
use think\Exception;
use think\Request;

class Base  extends BaseController
{
    const NOHAS_ERROR = 0;
    const HAS_ERROR = 1;

    const HTTP_OK = 200;
    const WEB_STOP = 4001;

    function __construct()
    {
        $request = Request::instance();
        if ($request->method() != "POST") {
            throw new Exception("非法请求");
        }
        $is_close = Db::name('options')->where('option_id', 6)->value('is_close');
        if (empty($is_close)) {

            $map = [
                'code'=>self::WEB_STOP,
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
            'code'=>self::HTTP_OK,
            'error'=>self::NOHAS_ERROR,
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
            'code'=>self::HTTP_OK,
            'error'=>self::HAS_ERROR,
            'msg'=>$msg
        ];

        echo json_encode($map);
        die;
    }
}