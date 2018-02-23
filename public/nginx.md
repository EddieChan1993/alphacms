ngnix配置

> cd /etc/nginx/conf.d

创建一个配置文件，文件名自定义

> vim alpha.conf

```
server {
    listen 80;
    #域名
    server_name    alpha.dcwen.top;
    #项目地址
    set        $root    /var/www/alphacms.com;
    location ~ .*\.(gif|jpg|jpeg|bmp|png|ico|txt|js|css)$
    {
        root $root;
    }
    location / {
        root    $root;
        index    index.html index.php;
        if ( -f $request_filename) {
            break;
        }
        if ( !-e $request_filename) {
            rewrite ^(.*)$ /index.php/$1 last;
            break;
        }
    }
    location ~ .+\.php($|/) {
    #需要注意php7.1更具你的当前版本而定
        fastcgi_pass    unix:/run/php/php7.1-fpm.sock;
        fastcgi_split_path_info ^((?U).+.php)(/?.+)$;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        fastcgi_param    SCRIPT_FILENAME    $root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
~
```
> 重启nigix

sudo nginx -t && sudo service nginx restart
### 常见问题:
解决ThinkPHP部署时Access denied.
编辑 /etc/php/7.1/fpm/php.ini 并替换cgi.fix_pathinfo=1