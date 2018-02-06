<?php
namespace app\admin\controller\core;
use app\admin\service\core\UpdateService;
use think\Db;
use think\Exception;

/**
 * 图库管理
 */
class Imgs extends Base
{
    function home_page()
    {
        $this->setTitle("图库管理");
        $this->setPanelTitle("图库列表");
        $this->model = "imgs";

        $map=$this->getDataList($_GET);
        return view('core/imgs/home_page',$map);
    }

    function del_think()
    {
        $imgArr=Db::name('imgs')
            ->where('id', input('id'))
            ->field('img_path,type')
            ->find();

        try {
            if (empty($imgArr)) {
                throw new Exception("该文件不存在");
            }
            $res=UpdateService::delFile($imgArr['img_path'], $imgArr['type'],input('id'));
            if (!$res) {
                throw new Exception(UpdateService::getErr());
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success("删除成功");
    }
}