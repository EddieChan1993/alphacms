<?php
/**
 * 切分SQL文件成多个可以单独执行的sql语句
 * @param $file sql文件路径
 * @param $tablePre 表前缀
 * @param string $charset 字符集
 * @param string $defaultTablePre 默认表前缀
 * @param string $defaultCharset 默认字符集
 * @return array
 * @throws Exception
 */
function cmf_split_sql($file, $tablePre, $charset = 'utf8mb4', $defaultTablePre = 'edd_', $defaultCharset = 'utf8mb4')
{
    if (file_exists($file)) {
        //读取SQL文件
        $sql = file_get_contents($file);
        $sql = str_replace("\r", "\n", $sql);
        $sql = str_replace("BEGIN;\n", '', $sql);//兼容 navicat 导出的 insert 语句
        $sql = str_replace("COMMIT;\n", '', $sql);//兼容 navicat 导出的 insert 语句
        $sql = str_replace($defaultCharset, $charset, $sql);
        $sql = trim($sql);
        //替换表前缀
        $sql  = str_replace(" `{$defaultTablePre}", " `{$tablePre}", $sql);
        $sqls = explode(";\n", $sql);
        return $sqls;
    }else{
        throw new Exception("数据库源文件不存在");
    }
}

function sp_execute_sql($db, $sql)
{
    $sql = trim($sql);
    preg_match('/CREATE TABLE .+ `([^ ]*)`/', $sql, $matches);
    if ($matches) {
        $table_name = $matches[1];
        $msg        = "创建数据表{$table_name}";
        try {
            $db->execute($sql);
            return [
                'error'   => 0,
                'message' => $msg . ' 成功！'
            ];
        } catch (\Exception $e) {
            return [
                'error'     => 1,
                'message'   => $msg . ' 失败！',
                'exception' => $e->getTraceAsString()
            ];
        }

    } else {
        try {
            $db->execute($sql);
            return [
                'error'   => 0,
                'message' => 'SQL执行成功!'
            ];
        } catch (\Exception $e) {
            return [
                'error'     => 1,
                'message'   => 'SQL执行失败！',
                'exception' => $e->getTraceAsString()
            ];
        }
    }
}

/**
 * 创建配置文件
 * @param $config
 * @return bool
 */
function sp_create_db_config($config)
{
    if (is_array($config)) {
        //读取配置内容
        $conf = file_get_contents(APP_PATH . 'install/data/config.php');

        //替换配置项
        foreach ($config as $key => $value) {
            $conf = str_replace("#{$key}#", $value, $conf);
        }

        try {
            $confDir = ROOT . 'data/conf/';
            if (!file_exists($confDir)) {
                mkdir($confDir, 0755, true);
            }
            file_put_contents(ROOT . 'data/conf/db.php', $conf);
        } catch (\Exception $e) {
            return false;
        }
        return true;

    }
}


/**
 * 随机字符串生成
 * @param int $len 生成的字符串长度
 * @return string
 */
function cmf_random_string($len = 6)
{
    $chars    = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    ];
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}
