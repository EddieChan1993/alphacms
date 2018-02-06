<?php
namespace app\admin\controller\core;

use app\admin\service\core\UpdateService;
use think\Db;
use think\Exception;

/**
 * 文件上传
 */
class Upload extends Base
{
    //单文件上传
    function show_upload_sigle()
    {
        $map = [
            'dom' => input('dom'),
            'path' => input('path'),
            'type' => input('type'),
        ];
        return view('core/upload/upload_sigle', $map);
    }

    //单文件上传逻辑
    function upload_sigle()
    {
        if (empty($_FILES)) {
            $this->error('请先上传图片');
        }
        if (input('qiniu_open')) {
            //七牛开启
            $res = UpdateService::updateQiniu($_FILES['files']);
        } else {
            $Url = 'admin/' . input('path') . '/';//上传缩略图
            $res = UpdateService::updateBase($Url);
        }

        if (!$res) {
            $this->error(UpdateService::getErr());
        }
        $this->success($res);
    }


    //删除单文件
    function del_sigle_file()
    {
        $imgArr = Db::name('imgs')
            ->where('img_path', input('file_path'))
            ->field('id,img_path,type')
            ->find();
        try {
            if (empty($imgArr)) {
                throw new Exception("该文件不存在");
            }
            $res = UpdateService::delFile($imgArr['img_path'], $imgArr['type'], $imgArr['id']);
            if (!$res) {
                throw new Exception(UpdateService::getErr());
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        //注意$this->success()放在Exception会异常
        $this->success(config('view_replace_str.__UPLOAD__') . '/admin/common/upload.svg');
    }
}