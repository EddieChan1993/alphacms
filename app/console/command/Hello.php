<?php
namespace app\console\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Log;

class Hello extends Command
{
    protected function configure()
    {
        //注册命令名称
        $this->setName("hello");
        $this->setDescription("hello example");
        //在command.php 配置后，console控制台输入php think hello可以执行下面的逻辑部分
        //php think list 可以看到所有可执行的脚本
    }

    protected function execute(Input $input, Output $output)
    {
        write_log("aaaaa", 'hello');
        //所有逻辑
        $str=strlen("ak=YwBMfAjdDqGQMWrwWgQrkHoES8h_sfQ4oJT7esdG|sk=b-laMNJSLbOyGj-W7qfyFOGWEtvinnaeOLZtAs2-|bucket=alphacms|cdn=p2otxz81j.bkt.clouddn.com");

        $output->write($str);
        $output->write("Hello World");
    }

}