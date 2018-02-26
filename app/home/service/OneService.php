<?php
namespace app\home\service;
use app\common\service\BaseService;
use think\Exception;
use think\exception\ErrorException;
use think\Log;

/**
 * 逻辑全部写再服务中
 */
class OneService extends BaseService
{
    public static function ChangeTest(array $param):bool
    {
        $flay = false;
        try {
            if ($param[0]==123) {
                throw new Exception("不为数组");
            }
            $flay = true;
        } catch (Exception $e) {
            self::setErr($e);
        }
        return $flay;
    }
}