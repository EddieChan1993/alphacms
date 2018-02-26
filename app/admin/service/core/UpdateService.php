<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/1/17
 * Time: 22:12
 */

namespace app\admin\service\core;


use app\common\extend\QiniuEx;
use app\common\service\BaseService;
use think\Db;
use think\Exception;
use think\Image;

class UpdateService extends BaseService
{
    /**
     * 上传到本地
     * @param string $pathBaseUrl
     * @return  string
     */
    public static function updateBase($pathBaseUrl)
    {
        $flag = "";
        $file_url = upload_sigle('files', $pathBaseUrl);

        try {
            if ($file_url) {
                $thumbUrl = config('view_replace_str.__UPLOAD__') . '/' . $pathBaseUrl . strtr($file_url, "\\", "/");
                $thumbUrl = parse_url($thumbUrl)['path'];
                //文件压缩
                add_img_db($thumbUrl, 0);
                $flag = $thumbUrl;
            } else {
                throw new Exception('文件上传失败');
            }
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 七牛上传
     * @param $file
     * @return mixed
     * @throws Exception
     */
    public static function updateQiniu($file)
    {
        $flag = "";
        Db::startTrans();
        try {
            $qiniu = QiniuEx::getInstance();
            $token = $qiniu->getToken();
            $filePath = $file['tmp_name'];
            $fileName = $file['name'];
            $res = $qiniu->uploadSimple($filePath, $fileName, $token);
            $key_plugin = plugins_value('qiniu', 'cdn');
            $qiniuUrl = sprintf("http://%s/%s",$key_plugin , $res['key']);
            //获取文件信息
            $fileInfo = $qiniu->getFileInfo($res["key"]);
            //插入表中
            add_img_db($qiniuUrl, 1, $fileInfo['fsize']);

            Db::commit();
            $flag = $qiniuUrl;
        } catch (\Exception $e) {
            self::setErr($e);
            Db::rollback();
        }
        return $flag;
    }

    /**
     * 删除文件
     * @param $file_path
     * @param $type
     * @param $id
     * @return bool
     * @internal param $file_path文件路径
     * @internal param $type文件来源
     * @internal param $id日志表id
     */
    public static function delFile($file_path,$type,$id)
    {
        $flag = false;
        Db::startTrans();
        try {
            $res=Db::name('imgs')->delete($id);
            if (!$res) {
                throw new Exception("数据库文件删除失败");
            }
            if ($type == 1) {
                //如果是七牛图片
                $urlArr = parse_url($file_path);
                $path = $urlArr['path'];
                $key = substr($path, 1);
                $qiniu = QiniuEx::getInstance();
                $qiniu->delFile($key);
            }else{
                //如果是本地图片
                $path = '.'.$file_path;
                array_map("unlink", glob($path));
                if (count(glob($path))) {
                    throw new Exception("文件删除失败");
                }
            }
            Db::commit();
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
            Db::rollback();
        }
        return $flag;
    }
}