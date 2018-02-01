<?php
namespace app\admin\controller\core;

use app\admin\service\ComService;
use app\common\controller\BaseController;
use think\Config;
use think\Db;
use think\Exception;
use think\Validate;

/**
 * 登录
 */
class Login extends BaseController
{
    function _initialize()
    {
        $comService = new ComService();
        if ($comService->isLogin()) {
            $this->redirect('admin/core.Index/index');
        }
    }

    function show_login()
    {
        return view('core/login/login_page');
    }

    //登陆判断
    function login_in()
    {
        $validate = new Validate([
            ['username', 'require', '用户名必须填写'],
            ['password', 'require', '密码必须填写'],
        ]);
        try {
            if (!$validate->check($_POST)) {
                throw new Exception($validate->getError());
            }

            if (!Config::get('app_debug')) {
                $luo_res = self::luosimao_respons(input('luotest_response'));
                if (!empty($luo_res['error'])) {
                    throw new Exception("验证无效,请重试");
                }
            }

            $users = Db::name('users')
                ->where('user_login', input('username'))
                ->find();

            //判断用户是否存在
            if ($users && $users['user_status'] != 0) {
                $inp_pass = encrypt_password(input('password'), $users['user_pass_salt']);//输入密码转义
                $is_sure = $users['user_pass'] == $inp_pass;//密码比对
                //判断密码是否相同
                if ($is_sure) {

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

                        $mess = $users['user_login'] . "第" . ($users['user_hits'] + 1) . "次登录";
                        write_log($mess, 'admin_log');
                    } else {
                        throw new Exception('用户登陆更新失败');
                    }
                } else {
                    throw new Exception('密码不正确');
                }
            } else {
                throw new Exception('该用户不存在或者被封');
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('身份认证成功,即将登陆', url('admin/core.Index/index'));
    }

    //螺丝帽验证码
    static function luosimao_respons($luotest_response)
    {
        $url = plugins_value('lsm_verify', 'url');
        $data = [
            'response' => $luotest_response,
            'api_key' => plugins_value('lsm_verify', 'api_key')
        ];
        $res = http_curl($url, 'post', 'json', $data);
        return $res;
    }
}