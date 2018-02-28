<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-02-06
 * Time: 18:06
 */

namespace app\admin\service\core;

use app\common\service\BaseService;
use think\Config;
use think\Db;
use think\Exception;
use think\Validate;

class LoginService extends BaseService
{
    public static function loginIn($param)
    {
        $flag = false;
        try {
            $validate = new Validate([
                ['username', 'require', '用户名必须填写'],
                ['password', 'require', '密码必须填写'],
            ]);
            if (!$validate->check($param)) {
                throw new Exception($validate->getError());
            }
            if (!Config::get('app_debug')) {
                $luo_res = self::luosimao_respons($param['luotest_response']);
                if (!empty($luo_res['error'])) {
                    throw new Exception("验证无效,请重试");
                }
            }

            $users = Db::name('users')
                ->where('user_login', $param['username'])
                ->find();
            //判断用户是否存在
            if (empty($users)) {
                throw new Exception('该用户不存在');
            }
            if ($users['user_status'] == 0) {
                throw new Exception('该用户被封,无法使用');
            }
            $inp_pass = encrypt_password($param['password'], $users['user_pass_salt']);//输入密码转义
            $is_sure = $users['user_pass'] == $inp_pass;//密码比对
            if (!$is_sure) {
                throw new Exception('密码不正确');
            }
            //判断密码是否相同
            $data_sign = [
                'id' => $users['id'],
                'last_login_time' => time(),
                'last_login_ip' => request()->ip(),
            ];
            $save_users = $data_sign;
            $save_users['user_hits'] = $users['user_hits'] + 1;

            if (Db::name('users')->update($save_users)) {
                cookie('UID', set_secret($users['id']), 604800);
                session('SUID', set_secret($users['id']));
                session('TOKEN_LOGIN', data_signature($data_sign));
                $flag = true;
                $mess = $users['user_login'] . "第" . ($users['user_hits'] + 1) . "次登录";
                write_log($mess, 'login');
            } else {
                throw new Exception('用户登陆更新失败');
            }
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    //螺丝帽验证码
    static function luosimao_respons($luotestRes)
    {
        $url = plugins_value('lsm_verify', 'url');
        $data = [
            'response' => $luotestRes,
            'api_key' => plugins_value('lsm_verify', 'api_key')
        ];

        $res = http_curl($url, 'post', 'json', $data);
        return $res;
    }
}