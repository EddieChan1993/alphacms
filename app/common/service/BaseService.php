<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/1/15
 * Time: 23:41
 */
namespace app\common\service;
use think\Controller;
use think\Log;

/**
 * 所有服务的基础类
 */
class BaseService extends Controller
{
    private static  $err;
    /**
     * @return mixed
     */
    static public function getErr()
    {
        return self::$err;
    }

    /**
     * @param mixed $err
     */
    public static function setErr($err)
    {
        $str = sprintf("%s[%s:%s]",$err->getMessage(),$err->getFile(),$err->getLine());
        Log::notice($str);
        self::$err = $err->getMessage();
    }

}