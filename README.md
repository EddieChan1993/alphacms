> AlphaCMS

## 环境
- [x] php7+
- [x] Redis

## 安装
确保文件已经删除
> E:\alphaCMS\data\install.lock
## 后台账号，密码
- [x] admin 
- [x] 666666
## 核心优化
> 1.E:\alphaCMS\thinkphp\library\think\App.php

在调试模式或非调试模式下指定都输出请求参数到日志
```
// 记录路由和请求信息
 if (self::$debug) {
    Log::record('[ ROUTE ] ' . var_export($dispatch, true), 'info');
    Log::record('[ HEADER ] ' . var_export($request->header(), true), 'info');
 }
 Log::record('[ PARAM ] ' . var_export($request->param(), true), 'info');
```

> 2.E:\alphaCMS\thinkphp\library\think\db\Query.php


```
/**
     * 自己的page分页
     * @param $page
     * @param null $listRows
     * @return $this
     */
    function epage()
    {
        $page=input('?page')?input('page'):1;
        $listRows = config('my_page.list_nums');
        if (is_null($listRows) && strpos($page, ',')) {
            list($page, $listRows) = explode(',', $page);
        }
        $this->options['page'] = [intval($page), intval($listRows)];
        return $this;
    }
```
> 3.E:\alphaCMS\thinkphp\library\think\cache\driver\Redis.php
```
 /**
      * 构造函数
      * @param array $options 缓存参数
      * @access public
      */
     public function __construct($options = [])
     {
         if (!extension_loaded('redis')) {
             throw new \BadFunctionCallException('not support: redis');
         }
         if (file_exists($file = ROOT_PATH . 'data/conf/redis.php')) {
             $this->options = array_merge($options, include($file));
         }
         if (!empty($options)) {
             $this->options = array_merge($this->options, $options);
         }
         $this->handler = new \Redis;
         if ($this->options['persistent']) {
             $this->handler->pconnect($this->options['host'], $this->options['port'], $this->options['timeout'], 'persistent_id_' . $this->options['select']);
         } else {
             $this->handler->connect($this->options['host'], $this->options['port'], $this->options['timeout']);
         }
 
         if ('' != $this->options['password']) {
             $this->handler->auth($this->options['password']);
         }
 
         if (0 != $this->options['select']) {
             $this->handler->select($this->options['select']);
         }
     }
```
## 第三方插件
##### 螺丝帽验证接口
[lusimao](https://luosimao.com/service/sms)
人机验证，项目部署在正式服务器上时，需要在luosimao官方平台配置当前项目域名
- [x] 默认调试模式是关闭人机验证的