<?php
namespace app\install\controller;
use think\Controller;
use think\Db;
use think\Exception;
use think\Log;

/**
 * 安装页面
 */
class Index extends Controller
{
    function _initialize()
    {
        if (is_installed()) {
            $this->redirect(request()->domain());
            exit;
        }
    }
    public function homePage()
    {
        return view('install');
    }

    public function install()
    {
        //创建数据库
        $dbConfig             = [];
        $dbConfig['type']     = "mysql";
        $dbConfig['hostname'] = input('dbhost');
        $dbConfig['username'] = input('dbuser');
        $dbConfig['password'] = input('dbpw');
        $dbConfig['hostport'] = input('dbport');
        $dbConfig['charset']  = input('dbcharset', 'utf8mb4');
        try {
            $dbName = input('dbname');
            $db = Db::connect($dbConfig);
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbName}` DEFAULT CHARACTER SET " . $dbConfig['charset'];
            $db->execute($sql);

            $dbConfig['database'] = $dbName;
            $dbConfig['prefix'] = trim(input('dbprefix'));
            $db = Db::connect($dbConfig);
            $sql = cmf_split_sql(APP_PATH . 'install/data/alphacms.sql', $dbConfig['prefix'], $dbConfig['charset']);

            foreach ($sql as $k => $v) {
                $sqlToExec = $v . ';';
                $result = sp_execute_sql($db, $sqlToExec);
                if ($result['error'] == 1) {
                    Log::error($sqlToExec . $result['message']);
                    throw new Exception("mysql导入失败");
                }
            }

            $dbConfig['authcode'] = cmf_random_string(18);
            $result = sp_create_db_config($dbConfig);
            if (!$result) {
                throw new Exception("数据库配置文件写入失败");
            }
            @touch(ROOT . 'data/install.lock');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success("alphaCMS安装成功");
    }
}