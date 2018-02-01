<?php
namespace app\admin\controller\core;

use app\admin\service\ComService;
use app\common\controller\BaseController;
use think\Db;
use think\Exception;
use think\View;

/**
 * 基础控制器
 */

class Base extends BaseController
{
    //操作模型
    protected $model;
    //总标题
    private $title="标题内容";
    //单页面
    private $panel_title="panel标题内容";
    //tab分页
    private $tab_1 = "tab_1";
    private $tab_2 = "tab_2";

    function __construct()
    {
        $comService=new ComService();
        if (!$comService->isLogin()) {
            $this->redirect('admin/core.Login/show_login');
        }
        if (!$comService->isLogin()) {
            $this->error($this->getErr());
        }
    }

    /**
     * 设置标题内容
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        View::share("title", $this->title);
    }

    /**
     * 设置panel标题内容
     * @param string $panel_title
     */
    public function setPanelTitle($panel_title)
    {
        $this->panel_title = $panel_title;
        View::share("panel_title",$this->panel_title);
    }

    /**
     * 设置tab_1
     * @param string $tab_1
     */
    public function setTab1($tab_1)
    {
        $this->tab_1 = $tab_1;
        View::share("tab_1", $this->tab_1);
    }

    /**
     * 设置tab_2
     * @param string $tab_2
     */
    public function setTab2($tab_2)
    {
        $this->tab_2 = $tab_2;
        View::share("tab_2", $this->tab_2);
    }

    /**
     * 获取数据列表,自定义查询模式，
     * @param $data
     * @return array
     * @throws Exception
     */
    protected function getDataList($data)
    {
        if (empty($this->model)) {
            throw new Exception("模型没有指定");
        }
        $conditions = [];
        if (!empty($data['condition']) && is_array($data['condition'])) {
            foreach ($data['condition'] as $key => $val) {
                if (!empty($val)||$val==="0") {
                    //排除为空的字段
                    $conditions [$key] = $val;
                }
            }
        }
        if (!empty($data['s_date']) && !empty($data['e_date'])) {
            $conditions['c_time']= ['BETWEEN',[strtotime($data['s_date']),strtotime($data['e_date'])]];
        }
        if (!empty($data['s_date'])&&empty($data['e_date'])) {
            $conditions['c_time']= ['>=',strtotime($data['s_date'])];
        }
        if (!empty($data['e_date'])&&empty($data['s_date'])) {
            $conditions['c_time']=['<=',strtotime($data['e_date'])];
        }
        //总个数
        $countNums = Db::name($this->model)
            ->where($conditions)
            ->count();
        //分页
        $pagesClass = new \Page($countNums);
        /**
         * 数据显示
         */
        $query = Db::name($this->model);
        //显示指定字段
        if (!empty($data['show'])) {
            $query->field($data['show']);
        }
        //不显示指定字段
        if (!empty($data['unshow'])) {
            $query->field($data['unshow'],true);
        }
        $modelList = $query
            ->where($conditions)
            ->order('id desc')
            ->epage()
            ->select();

        $data = [
            'dataArr' => $modelList,//每页数据
            'pages' => $pagesClass->showPages(3),//分页按钮
            'dataNums' => $countNums,//总个数
            'get'=>$_GET
        ];
        return $data;
    }

    /***************************************默认控制器CURD页面逻辑渲染**********************************************/
    //首页
    public function homePage()
    {
        $data=$this->getDataList($_GET);
        return view('home_page',$data);
    }

    //编辑详情
    public function editPage()
    {
        $data = Db::name($this->model)->find(input('id'));
        return view('edit_page', $data);
    }

    //编辑逻辑
    public function editThink()
    {
        if (Db::name($this->model)->update($_POST)) {
            $this->success("编辑成功");
        }else{
            $this->error("未作任何更新");
        }
    }

    //插入逻辑
    public function addThink()
    {
        $addData = $_POST;
        $addData['c_time'] = time();
        if (Db::name($this->model)->insert($addData)) {
            $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }
    }

    //删除逻辑
    public function delThink()
    {
        if (Db::name($this->model)->delete(input('id'))) {
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
}
