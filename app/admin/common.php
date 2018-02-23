<?php
use think\cache\driver\Memcache;
use think\Db;
/**
 * 获取用户信息
 * @param $user_id
 * @return array|false|PDOStatement|string|\think\Model
 */
function get_users($user_id)
{
    $user=Db::name('users')->find($user_id);
    return $user;
}

/**
 * 获取管理员角色
 * @param $user_id
 * @return mixed
 */
function get_role($user_id)
{
    $name=Db::name('users')
        ->alias('u')
        ->where('ra.user_id',$user_id)
        ->join('role_user ra', 'ra.user_id=u.id')
        ->join('role r', 'r.id=ra.role_id')
        ->value('name');
    return $name;
}

function del_role_log($user_id, $role_id)
{
    $map = [
        'user_id'=>$user_id,
        'role_id'=>$role_id
    ];

    $role_user_id=Db::name('role_user')->where($map)->value('role_user_id');
    if ($role_user_id) {
        Db::name('role_user')->delete($role_user_id);
    }
    return 'ok';
}

/**
 * 添加图片日志
 * @param $path
 * @param $type
 * @param string $fileSize
 * @throws Exception
 */
function add_img_db($path,$type,$fileSize="")
{
    if ($type == 0) {
        $filePath = ".".$path;
        $fileSize = filesize($filePath);
    }
    $map = [
        'upload_date'=>time(),
        'img_size' => getFileSize($fileSize),
        'ip'=>request()->ip(),
        'user_id' => open_secret(cookie('UID')),
        'img_path'=>$path,
        'type'=>$type,
    ];
    $res=Db::name('imgs')->insert($map);
    if (!$res) {
        throw new Exception("图片插入日志错误");
    }
}

/**
 * 删除图片日志
 * @param $path
 * @return array
 */
function del_img_db($path)
{
    $img_id=Db::name('imgs')
        ->where('img_path', $path)
        ->value('img_id');
    dump($img_id);
    die;
    if (empty($img_id)) {
        $map=[
            'error'=>1,
            'msg' => '文件已经被删掉了',
        ];
    }else{
        $map=[
            'error'=>0,
            'msg' => '数据库清除成功',
        ];
    }

    return $map;
}

/**
 * 是否禁用
 * @param $type
 * @return string
 */
function is_stop($type)
{
    if ($type == 0) {
        return '<span class="label label-danger">非正常</span>';
    } elseif ($type == 1) {
        return '<span class="label label-success">正常</span>';
    }
}

/**
 * 菜单类型
 * @param $name
 * @param $type
 * @return string
 */
function menu_type($name,$type)
{
    if ($type == 0) {
        return '<span class="label label-default">'.$name.'</span>';
    } elseif ($type == 1) {
        return '<span class="label label-warning">'.$name.'</span>';
    }
}

/**
 * select框是否选中
 * @param $select_id
 * @param $id
 * @return string
 */
function is_selected($select_id, $id)
{
    return $select_id == $id ? 'selected' : '';
}

/**
 * checked是否选中
 * @param $is_ok
 * @return string
 */
function is_checked($is_ok)
{
    return $is_ok ? 'checked' : '';
}

/**
 * 默认头像
 * @param $img
 * @return string
 */
function is_img($img)
{
    return $img ? $img : config('view_replace_str.__UPLOAD__') . '/admin/common/upload.svg';
}

/**
 * 获取文章分类名称
 * @param $posts_id
 * @return false|PDOStatement|string|\think\Collection
 * @internal param $posts_id文章id
 */
function get_terms($posts_id)
{
    $terms=Db::name('terms')
        ->alias('t')
        ->where('object_id',$posts_id)
        ->join('term_relationships r', 'r.term_id=t.term_id')
        ->select();
    return $terms;
}

/**
 * 判断文章所属类型
 * @param $posts_id
 * @param $term_id
 * @return string
 */
function post_term($posts_id,$term_id)
{
    $map = [
        'object_id'=>$posts_id,
        'term_id'=>$term_id
    ];
    $terms=Db::name('term_relationships')

        ->where($map)
        ->select();
    if (!empty($terms)) {
        return 'selected';
    }else{
        return '';
    }
}
/**
 * 获取插件参数
 * @param $param
 * @return array
 */
function get_param_arr($param)
{
    $arr=explode('|', $param);
    return $arr;
}

/**
 * 获取站点配置信息
 * @param $name
 * @return mixed
 */
function get_options($name)
{
    $option_value=Db::name('options')->where('option_id',6)->value('option_value');
    return getAttr($option_value, $name);
}

function rm_cache_menu()
{
    if (extension_loaded("memcache")) {
        $mem = new Memcache();
        $mem->rm('menu');
    }
}

/**
 * 获取菜单导航
 * @param $menu_id
 * @param $parend_id
 * @return string
 */
function get_menu_nav($menu_id,$parend_id)
{
    $parend_nav=Db::name('menu')
        ->where('id',$parend_id)
        ->value('nav_list');
    $nav = '';
    if (!empty($parend_nav)) {
        $nav .=$parend_nav.'-';
    }
    $nav .=$menu_id;
    return $nav;
}

/**
 * 获取管理员对应角色nav_list
 * @param $user_id
 * @return mixed
 */
function get_role_nav($user_id)
{
    $name=Db::name('users')
        ->alias('u')
        ->where('ra.user_id',$user_id)
        ->join('role_user ra', 'ra.user_id=u.id')
        ->join('role r', 'r.id=ra.role_id')
        ->value('r.nav_list');
    $name = explode('-', $name);
    return $name;
}

/**
 * 获取指定菜单控制器等
 * @param $menu_id
 * @return array|false|PDOStatement|string|\think\Model
 */
function get_menu($menu_id)
{
    $menu=Db::name('menu')
        ->field('module,controller,method')
        ->find($menu_id);
    return $menu;
}

/**
 * 对应角色权限nav_list
 * @return string
 */
function menu_nav_list()
{
    $user_id=open_secret(cookie('UID'));
    $name=Db::name('users')
        ->alias('u')
        ->where('ra.user_id',$user_id)
        ->join('role_user ra', 'ra.user_id=u.id')
        ->join('role r', 'r.id=ra.role_id')
        ->value('r.nav_list');
    $name = explode('-', $name);
    $menu_in = implode(',', $name);
    return $menu_in;
}
/*==========================================================extra=====================================================*/