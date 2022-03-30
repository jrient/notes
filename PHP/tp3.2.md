TP3.2源码 - 红薯版

## 配置

| 配置项 | 值 | 说明 |
| :- | :-: | :-: | 
| APP_DEBUG | true/false | 调试模式 |
| BUILD_DIR_SECURE | true/false | 生成安全文件 |
| APP_PATH | path/Application | 应用目录 |
| THINK_VERSION | 3.2.3 | TP框架版本 |
| EXT | .class.php | 类文件后缀 |


## 应用入口 index.php
1. 设置 APP_DEBUG 调试模式开关
2. 设置 BUILD_DIR_SECURE 安全文件开关
3. 设置 APP_PATH 应用目录
4. 引入TP入口文件 `ThinkPHP/ThinkPHP.php`

## TP框架公共入口 ThinkPHP.php
1. 记录开始运行时间
2. 记录初始内存使用情况
3. 记录版本信息 THINK_VERSION
4. 定义模式常量
    - URL_COMMON    0   普通模式
    - URL_PATHINFO  1   pathinfo模式
    - URL_REWRITE   2   rewrite模式
    - URL_COMPAT    3   兼容模式
5. 定义类文件后缀   EXT '.class.php'
6. 定义系统常量
    - THINK_PATH
    - APP_PATH
    - APP_STATUS
    - APP_DEBUG
7. 检测SAE环境
    - APP_MODE      sae/common  应用模式
    - STORAGE_TYPE  Sae/File    存储模式
8. 定义系统常量
    - RUNTIME_PATH  APP_PATH.Runtime        系统运行目录
    - LIB_PATH      THINK_PATH.Library      系统核心类库目录
    - CORE_PATH     LIB_PATH.Think          Think类目录
    - BEHAVIOR_PATH LIB_PATH.Behavior       行为类目录
    - MODE_PATH     THINK_PATH.Mode         系统应用模式目录
    - VENDOR_PATH   LIB_PATH.Vendor         第三方类库目录
    - COMMON_PATH   APP_PATH.Common         应用公共目录
    - LANG_PATH     RUNTIME_PATH.Lang       应用语言目录
    - HTML_PATH     RUNTIME_PATH.Html       应用静态目录
    - LOG_PATH      RUNTIME_PATH.Logs       应用日志目录
    - TEMP_PATH     RUNTIME_PATH.Temp       应用缓存目录
    - DATA_PATH     RUNTIME_PATH.Data       应用数据目录
    - CACHE_PATH    RUNTIME_PATH.Cache      应用模板缓存目录
    - CONF_EXT      .PHP                    配置文件后缀
    - CONF_PARES                            配置文件解析方法
    - ADDON_PATH    APP_PATH.Addon          
9. 检测php版本 设置MAGIC_QUOTES_GPC 开关
10. 检测php和web服务器的接口类型
    - IS_CGI
    - IS_WIN
    - IS_CLI
11. 加载核心Think类 require ThinkPHP/Library/Think/Think.class.php
12. 初始化 Think\Think::start()

## ThinkPHP内核初始化
1. 注册autoload   spl_autoload_register
    - 若在classMap中有映射,直接通过classMap获取文件位置并 include (初始化的时候，必定会先走这一步)
    - 若传入的是不带层级的类名，检查是否是基础类名(Think, Org, Behavior, Com, Vendor)，是则指向对应的Library目录下，否则在AUTOLOAD_NAMESPACE配置下的默认路径查找
    - 若为常规命名空间，检查APP_USE_NAMESPACE 开关，根据命名空间进行文件寻址
2. 设置异常处理机制
    
      


## 框架目录结构
www  WEB部署目录（或者子目录）
├─index.php       入口文件
├─README.md       README文件
├─Application     应用目录
├─Public          资源文件目录
├─Runtime         运行时目录
├─ThinkPHP        框架目录
│  ├─Common       核心公共函数目录
│  ├─Conf         核心配置目录 
│  ├─Lang         核心语言包目录
│  ├─Library      框架类库目录
│  │  ├─Think     核心Think类库包目录
│  │  ├─Behavior  行为类库目录
│  │  ├─Org       Org类库包目录
│  │  ├─Vendor    第三方类库目录
│  │  ├─ ...      更多类库目录
│  ├─Mode         框架应用模式目录
│  ├─Tpl          系统模板目录
│  ├─LICENSE.txt  框架授权协议文件
│  ├─logo.png     框架LOGO文件
│  ├─README.txt   框架README文件
│  └─ThinkPHP.php    框架入口文件