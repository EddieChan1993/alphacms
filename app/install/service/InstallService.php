<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-02-02
 * Time: 9:43
 */

namespace app\install\service;


use app\common\service\BaseService;
use Exception;
use think\Db;
use think\Log;

class InstallService extends BaseService
{
    public static function importDbData($postParam)
    {

        try {
            $flag = false;
            $dbConfig             = [];
            $dbConfig['type']     = "mysql";
            $dbConfig['hostname'] = $postParam['dbhost'];
            $dbConfig['username'] = $postParam['dbuser'];
            $dbConfig['password'] = $postParam['dbpw'];
            $dbConfig['hostport'] = $postParam['dbport'];
            $dbConfig['charset']  = "utf8mb4";
            $dbName = $postParam['dbname'];
            //创建数据库
            $db = Db::connect($dbConfig);
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET " . $dbConfig['charset'];
            $db->execute($sql);
            //创建表
            $dbConfig['database'] = $dbName;
            $dbConfig['prefix'] = trim($postParam['dbprefix']);
            $db = Db::connect($dbConfig);
            $sql = cmf_split_sql(APP_PATH . 'install/data/alphacms.sql', $dbConfig['prefix'], $dbConfig['charset']);

            foreach ($sql as $k => $v) {
                $sqlToExec = $v . ';';
                $result = sp_execute_sql($db, $sqlToExec);
                if ($result['error'] == 1) {
                    Log::notice($result['message']);
                    throw new Exception("mysql导入失败");
                }
            }

            $dbConfig['authcode'] = cmf_random_string(18);
            $result = sp_create_db_config($dbConfig);
            if (!$result) {
                throw new Exception("数据库配置文件写入失败");
            }
            //生成安装锁
            @touch(ROOT . 'data/install.lock');
            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }
}