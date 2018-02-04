<?php
use think\Db;
use think\Exception;
use think\Model;

class Auth extends Model
{
    //默认配置
    protected $_config = array(
        'auth_on' => true,           // 认证开关
        'auth_type' => 1,                // 认证方式，1为实时认证；2为登录认证。
        'auth_group' => 'role',      // 角色表
        'auth_group_access' => 'role_user', // 用户-角色关系表
        'auth_rule' => 'menu',         // 权限规则表
        'auth_user' => 'users',     // 用户信息表
        'auth_open_id' => [1]            //不需要验证的id
    );

    public function __construct()
    {
        if (config('auth_config')) {
            //可设置配置项 auth_config, 此配置项为数组。
            $this->_config = array_merge($this->_config, config('auth_config'));
        }
    }

    public function check($uid)
    {
        $flag = false;
        try {
            if (in_array($uid, $this->_config['auth_open_id']) && !empty($this->_config['auth_open_id'])) {
                //如果配置的有不需要验证的id，那么判断和该用户id是否匹配
                $flag = true;
            } else {
                if ($this->_config['auth_on']) {
                    //获取当前的[模块][控制器][操作方法]
                    $module = Request()->module();
                    $controller = Request()->controller();
                    $action = Request()->action();

                    $map = [
                        'module' => $module,
                        'controller' => $controller,
                        'method' => $action
                    ];
                    $authOne = Db::name($this->_config['auth_rule'])->where($map)->find();
                    if ($authOne['type'] == 1) {
                        //该菜单是否需要验证
                        if ($authOne['status'] == 1) {
                            //只对没被禁用的菜单进行验证
                            $this->role_rule_in($uid, $authOne['id'], $authOne['name']);
                        } else {
                            throw new Exception($authOne['name'] . '权限【被暂时禁用】');
                        }
                    }
                }
                $flag = true;
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
        return $flag;
    }

    /**
     * 判断该角色是否拥有该权限
     * @param $uid
     * @param $rule_id
     * @param $rule_name
     * @throws Exception
     */
    function role_rule_in($uid, $rule_id, $rule_name)
    {
        $groupAccess = Db::name($this->_config['auth_group_access'])
            ->order('role_user_id desc')
            ->where('user_id', $uid)
            ->find();
        $group = Db::name($this->_config['auth_group'])->find($groupAccess['role_id']);

        if ($group['status']) {
            $rules = explode(',', $group['rules']);
            if (in_array($rule_id, $rules)) {
                //写入操作日志
                $mess = $uid . '【操作】' . $rule_name;
                write_log($mess, 'auth_log');
                //拥有该权限
            } else {
                //该角色不包含该权限
                throw new Exception('无权操作【'.$rule_name.'】权限');
            }
        } else {
            //该角色所有权限被禁
            throw new Exception('该角色所有权限暂时【被禁用】');
        }

    }

    /**
     * 获取当前用户的权限菜单
     * @param $uid
     * @return array
     */
    function get_auth_menu($uid)
    {
        if (config('auth_config.auth_open_id')[0] == $uid) {
            //超级用户id，不需要被验证，拥有所有权限
            $req = [
                'type' => 0,
                'status' => 1,//没被禁用的
            ];
        } else {
            $groupAccess = Db::name($this->_config['auth_group_access'])
                ->where('user_id', $uid)
                ->find();
            $group = Db::name($this->_config['auth_group'])
                ->find($groupAccess['role_id']);

            $rules = explode(',', $group['rules']);

            $req = [
                'id' => ['in', $rules],
                'status' => 1,//没被禁用的
                'type' => 0//仅仅是菜单
            ];
        }

        $menuArr = Db::name($this->_config['auth_rule'])
            ->where($req)
            ->order('listorder desc')
            ->select();//权限tree

        $menuAuth = get_tree_array($menuArr, 'parentid');//菜单树
        return $menuAuth;
    }
}