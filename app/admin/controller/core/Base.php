<?php
namespace app\admin\controller\core;

use app\admin\service\ComService;
use app\common\controller\BaseController;
use app\common\service\CurdService;
use think\Db;
use think\Exception;
use think\Request;
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
        parent::_initialize();
        $req = Request::instance();
        if ($req->baseFile() == "/index.php") {
            //入口文件index.php禁止访问后台管理系统
            throw new Exception("非法请求");
        }
        $comService=new ComService();
        if (!$comService->isLogin()) {
            $this->redirect('admin/core.Login/show_login');
        }
        if (!$comService->verifyAuth()) {
            $this->error(ComService::getErr());
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
     * @param string $filed
     * @return array
     * @throws Exception
     */
    protected function getDataList($data,$filed='*')
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
            $conditions['c_time']= ['BETWEEN',[strtotime($data['s_date']),strtotime($data['e_date'])+86400]];
        }
        if (!empty($data['s_date'])&&empty($data['e_date'])) {
            $conditions['c_time']= ['>=',strtotime($data['s_date'])];
        }
        if (!empty($data['e_date'])&&empty($data['s_date'])) {
            $conditions['c_time']=['<=',strtotime($data['e_date'])+86400];
        }
        //总个数
        $countNums = Db::name($this->model)
            ->where($conditions)
            ->count();
        //分页
        $pagesClass = new \Page($countNums);
        $modelList = CurdService::name($this->model)
            ->getPageData($conditions, $filed);

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
        $whereData = ['id' => input('id')];
        $data = CurdService::name($this->model)
            ->getOneData($whereData, 'id,name');
        return view('edit_page', $data);
    }

    //编辑逻辑
    public function editThink()
    {
        $res = CurdService::name($this->model)
            ->update($_POST);
        if ($res) {
            $this->success("编辑成功");
        }else{
            $this->error("未作任何更新");
        }
    }

    //插入逻辑
    public function addThink()
    {
        $res = CurdService::name($this->model)
            ->add($_POST);
        if ($res) {
            $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }
    }

    //删除逻辑
    public function delThink()
    {
        $res = CurdService::name($this->model)
            ->del(input('id'),true);
        if ($res) {
            $this->success("删除成功");
        }else{
            $this->error($res);
        }
    }
}
