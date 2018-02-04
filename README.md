> AlphaCMS
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
## 第三方插件
##### 螺丝帽验证接口
[lusimao](https://luosimao.com/service/sms)
人机验证，项目部署在正式服务器上时，需要在luosimao官方平台配置当前项目域名
- [x] 默认调试模式是关闭人机验证的