<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-02-23
 * Time: 12:51
 */

namespace app\home\controller\v1;
use think\Controller;
//http://127.0.0.16/v1.Test/index
class Test extends Controller
{
    function index()
    {
        echo 'Welcome To Use <strong>AlphaCMS</strong>_v' . ALPHACMS_VERSION;
    }
}