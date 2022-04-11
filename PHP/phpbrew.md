phpbrew 是一个构建、安装多版本 PHP 到用户根目录的工具。

[项目地址](https://github.com/phpbrew/phpbrew)
[文档地址](https://github.com/phpbrew/phpbrew/blob/master/README.cn.md)

## 安装

```
curl -L -O https://github.com/phpbrew/phpbrew/releases/latest/download/phpbrew.phar
chmod +x phpbrew.phar

# Move the file to some directory within your $PATH
sudo mv phpbrew.phar /usr/local/bin/phpbrew
```

## 开始

初始化

> phpbrew init

根据提示编辑 `~/.bashrc`

```
Paste the following line(s) to the end of your ~/.bashrc and start a new shell, phpbrew should be up and fully functional from there:
在 ~/.bashrc末尾添加以下命令，并重启shell以启用功能
    source /root/.phpbrew/bashrc

To enable PHP version info in your shell prompt, please set PHPBREW_SET_PROMPT=1
in your `~/.bashrc` before you source `~/.phpbrew/bashrc`
在 source /root/.phpbrew/bashrc 之前添加以下命令，在命令行中启用php版本信息
( 很丑 不喜欢)
    export PHPBREW_SET_PROMPT=1

To enable .phpbrewrc file searching, please export the following variable:
在 source /root/.phpbrew/bashrc 之前添加以下命令，在命令行中启用phpbrewrc文件搜索

    export PHPBREW_RC_ENABLE=1
```
## 基础用法

### known

列出已知 PHP 版本: `phpbrew known`

列出更多次要版本：`phpbrew known --more`

刷新 PHP 发布信息: `phpbrew update`

刷新旧版本(<5.4)：`phpbrew update --old`

列出已知旧版： `phpbrew known --old`

### install

安装: `phpbrew install 8.0 +default`

`default`代表默认参数集合，如果需要最小安装则删除`default`

可以使用 `-j` 或者 `--jobs` 选项启用并行编译： `phpbrew install -j $(nproc) 8.0 +default`

安装旧版: `phpbrew install --old 5.2.13`

通过指定的github tag或branch安装: `phpbrew install github:php/php-src@PHP-7.2 as php-7.2.0-dev`

### switch

临时切换 PHP 版本：`phpbrew use 5.4.22`

切换默认 PHP 版本：`phpbrew switch 5.4.18`

关闭 phpbrew：`phpbrew off`

### list

列出已安装的 PHP：`phpbrew list`

你可以在 ~/.phpbrew/php 目录找到已安装的 PHP
