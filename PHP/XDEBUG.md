## XDEBUG配置方法 
[xdebug下载地址](https://xdebug.org/docs/install)

环境：centos8云服务器 + win10客户端 + phpstorm2021.1

### 服务器端配置 

1. 下载并编译安装xdebug

```
wget https://xdebug.org/files/xdebug-3.1.4.tgz
tar zxvf xdebug-3.1.4.tgz
cd xdebug-3.1.4/
# 服务器phpize绝对路径
/usr/local/php/bin/phpize
# config= 服务器php-config绝对路径
./configure --enable-xdebug --with-php-config=/usr/local/php/bin/php-config
make && make install
```

2. 修改php.ini 启用xdebug

在php.ini底部增加如下代码

```
[xdebug]
zend_extension="xdebug.so"
xdebug.mode = develop,debug
xdebug.client_host=localhost
xdebug.client_port=9001
xdebug.log = /tmp/xdebug.log
debug.idekey = "PHPSTORM"
```

设置模式为`develop,debug`,

设置客户端通信端口为`9001`,

设置客户端ip地址为`localhost`(因为客户端没有外网ip，后面会解决)

重启php-fpm `service php-fpm restart`

### 客户端配置

phpstorm->文件->设置(或者`ctrl+alt+s`)

1. 语言和框架->PHP(或者直接是PHP)


PHP 语言级别： 要求和 CLI解释器 设置后的语言级别相同

CLI解释器设置(CLI解释器最右侧...) :

    名称： 随意

    ssh配置： 这个不解释

    常规 -> PHP可执行文件 ： 选择你服务器上的php可执行文件地址，`/usr/local/php/bin/php`

路径映射: 根据自己实际项目路径和服务器项目路径设置 `C:/data/mine/demo - /data/wwwroot/demo`

2. 调试
    找到Xdebug 栏目，调试端口默认为`9001,9003`，同服务器上`xdebug.client_port`相同即可

3. 调试->DBGp代理
    
    IDE键：同`xdebug.idekey`值,值为`PHPSTORM`

    主机: 同`xdebug.client_host`值,值为`localhost` 

    端口: 同`xdebug.client_port`值,值为`9001`

4. phpstorm->运行->调试配置
    
    左上角`+`号，添加你所需要的配置，以`PHP Web页面`为例，

    配置->服务器：选择之前建立的服务器

    配置->起始url: 单例文件框架为`/index.php`

    配置->调试预配置->`验证`: 

        创建验证脚本路径: `C:\data\mine\demo\public`

        部署服务器: 选择服务器,注意如`laravel`入口文件在public下的，则需要多建立一条到public下的映射

        期望验证结果为： 除了提示修改`xdebug.client_host`，其他均能通过即可

5. 由于xdebug需要由服务端向客户端通信，而客户端没有实际ip地址，则采用`ssh远程端口转发`的模式(或者frp),将服务器`9001`端口映射到客户端`9001`端口

> ssh -R 9001:localhost:9001 root@1.2.3.4


最后在 index.php 中打断点调试检查是否正常即可