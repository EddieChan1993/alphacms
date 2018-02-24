<?php
namespace app\admin\controller\core;

use think\cache\driver\Memcache;
use think\cache\driver\Redis;
use think\Db;
use think\Exception;
use think\Validate;

/**
 * 菜单管理
 */
class Menu extends Base
{
    //菜单显示
    function home_page()
    {
        if (!extension_loaded('redis')) {
            //没装memcache
            $menu_list = Db::name('menu')->select();
            $menu_list = menu_left($menu_list, 'id', 'parentid');
        }else{
            $mem = new Redis();
            if ($mem->has('menu')) {
                $menu_list = $mem->get('menu');
            }else{
                $menu_list = Db::name('menu')->select();
                $menu_list = menu_left($menu_list, 'id', 'parentid');
                $mem->set('menu', $menu_list);
            }
        }

        $menu_nums = Db::name('menu')->count();
        $controller = ROOT_PATH . DS . 'app/admin/controller';
        $controller = list_file($controller,"*.php");//文章内页模板
        $menu_map = [
            'menu_nums'=>$menu_nums,
            'menu_list'=>$menu_list,
            'controller'=>$controller
        ];

        if (input('?menu_id')) {
            $menu_map['menuChild'] =input('menu_id') ;
        }
        return view('core/menu/home_page',$menu_map);
    }

    //删除菜单
    function del_think()
    {
        $childMenu = Db::name('menu')->where('parentid',input('id'))->select();
        if (!empty($childMenu)) {
            $this->error('当前菜单下存在子菜单,请谨慎操作');
        }else{
            if (Db::name('menu')->delete(input('id'))) {
                rm_cache_menu();
                $this->success('当前菜单删除成功',url('admin/Menu/menu_page'));
            }else{
                $this->error('当前菜单删除失败');
            }
        }
    }
    //添加菜单
    function add_think()
    {
        $validate = new Validate([
            ['name','require|unique:menu','菜单名称必填|菜单名称重复'],
            ['module','require','模块必须填写'],
            ['method','require','方法必须填写']
        ]);
        if (!$validate->check($_POST)) {
            $this->error($validate->getError());
        }

        $add_data = array_remove($_POST,'extra_controller');
        if (!empty(input('extra_controller'))) {
            //多级控制器不为空
            $add_data['controller'] = input('extra_controller');
        }
        if ($menu_id=Db::name('menu')->insertGetId($add_data)) {
            $save_menu['id'] = $menu_id;
            $save_menu['nav_list'] = get_menu_nav($menu_id, input('parentid'));
            Db::name('menu')->update($save_menu);

            rm_cache_menu();
            $this->success('菜单添加成功');
        }else{
            $this->success('菜单添加失败');
        }
    }

    //菜单编辑页面
    function edit_page()
    {
        $menu_list = Db::name('menu')->select();
        $menu_list = menu_left($menu_list, 'id', 'parentid');

        $controller = ROOT_PATH . DS . 'app/admin/controller/';
        $controller = list_file($controller,"*.php");//文章内页模板

        $menus = Db::name('menu')->find(input('menu_id'));
        $menu_map = $menus;
        $menu_map['menu_list'] = $menu_list;
        $menu_map['cont']=$controller;
        return view('core/menu/edit_page', $menu_map);
    }

    //菜单编辑逻辑
    function edit_think()
    {
        $validate = new Validate([
            ['name','require|unique:menu','菜单名称必填|菜单名称重复'],
            ['module','require','模块必须填写'],
            ['method','require','方法必须填写']
        ]);
        if (!$validate->check($_POST)) {
            $this->error($validate->getError());
        }

        $edit_data = array_remove($_POST,'extra_controller');
        if (!empty(input('extra_controller'))) {
            //多级控制器不为空
            $edit_data['controller'] = input('extra_controller');
        }

        $edit_data['nav_list'] = get_menu_nav(input('id'), input('parentid'));
        if (!input('?status')) {
            $edit_data['status'] = input('status')?input('status'):0;
        }

        if (Db::name('menu')->update($edit_data)) {
            rm_cache_menu();
            $this->success('菜单编辑成功');
        }else{
            $this->error('菜单未做任何修改');
        }
    }
    //菜单顺序修改
    function update_order()
    {
        if (Db::name('menu')->update($_POST)) {
            rm_cache_menu();
            $this->success('菜单排序编辑成功');
        }else{
            $this->error('菜单排序编辑未做任何修改');
        }
    }
}