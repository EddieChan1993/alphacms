<?php
namespace app\admin\service;
use app\admin\service\core\AuthService;
use app\common\service\BaseService;
use Exception;

class ComService extends BaseService
{
    function isLogin()
    {
        $flag = false;
        try {
            if (session('SUID')) {
                $users = get_users(open_secret(session('SUID')));
                if ($users) {
                    $user_map = [
                        'id'=>$users['id'],
                        'last_login_time'=>$users['last_login_time'],
                        'last_login_ip' => $users['last_login_ip'],
                    ];
                    $token_login = data_signature($user_map);
                    if (session('TOKEN_LOGIN') == $token_login) {
                        cookie('UID', set_secret($users['id']),604800);//再次计时
                        $flag= true;
                    }
                }
            }else{
                if (cookie('UID')) {
                    $users=get_users(open_secret(cookie('UID')));
                    if ($users && $users['user_status'] != 0) {
                        cookie('UID', set_secret($users['id']),604800);//再次计时
                        $flag= true;
                    }
                }
            }
        } catch (Exception $e) {
            self::setErr($e);
        }

        return $flag;
    }

    /**
     * 权限验证
     * @return bool
     */
    public function verifyAuth()
    {
        $flag = false;
        try{
            $auth = new AuthService();
            $auth->check(open_secret(cookie('UID')));
            $flag = true;
        }catch (Exception $e){
            self::setErr($e);
        }
        return $flag;
    }
}