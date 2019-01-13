# php 版本升级新特性与废弃特性整理

#### PHP7.1 - PHP7.2
##### 新特性
- 新的对象类型object
- 直接可以通过名称加载扩展
- 允许重写抽象方法
- 使用Argon2算法生成密码散列
- 新增 ext/PDO（PDO扩展） 字符串扩展类型
- 为 ext/PDO新增额外的模拟调试信息
- ext/LDAP（LDAP扩展） 支持新的操作方式
- ext/sockets（sockets扩展）添加了地址信息
- 重写方法和接口实现的参数类型现在可以省略了
- 允许分组命名空间的尾部逗号
- [文档](https://secure.php.net/manual/zh/migration72.new-features.php)

##### 废弃特性
- 不再支持不带引号的字符串
- 废弃 png2wbmp() 和 jpeg2wbmp()
- 废弃 INTL_IDNA_VARIANT_2003 转化
- 废弃 __autoload() 方法 ， 请使用 spl_autoload_register()
- 废弃 track_errors ini设置
- 废弃 create_funtion()
- 废弃 mbstring.func_overload ini设置
- 废弃 (unset)类型强制转化
- parse_str() 第二个参数为必填项
- 废弃 gmp_random()
- 废弃 each()
- assert()禁止传入字符串参数
- 废弃 错误处理器内的 $errcontext参数
- 废弃 read_exif_data() 修改为 exif_read_data()
- [文档](https://secure.php.net/manual/zh/migration72.deprecated.php)

#### PHP7.0 - PHP7.1
##### 新特性
- 可为空类型 (Nullable)
- void函数
- 短数组语法（[]），现在作为list()语法的一个备选项，可以用于将数组的值赋给一些变量
- 支持设置常量可见性
- iterable伪类
- 多异常捕获处理
- list()支持指定键名
- 所有支持偏移量的字符串操作函数 都支持接受负数作为偏移量
- ext/openssl 支持 AEAD
- 一个新的名为 pcntl_async_signals() 的方法现在被引入， 用于启用无需 ticks （这会带来很多额外的开销）的异步信号处理。
- HTTP/2 server push support in ext/curl 一个对服务器推送的支持的扩展
- [文档](https://secure.php.net/manual/zh/migration71.new-features.php)

##### 废弃特性
- 当传递参数过少时将抛出错误
- 禁止动态调用以下函数
    - assert() - with a string as the first argument
    - compact()
    - extract()
    - func_get_args()
    - func_get_arg()
    - func_num_args()
    - get_defined_vars()
    - mb_parse_str() - with one arg
    - parse_str() - with one arg
- 无效的class、interface、trait 名 (系统占用的关键字)
    - viod
    - iterable
- 字符串转换支持科学表示法
- 修正mt_rand()算法
- rand()的别名为mt_rand();srand()的别名为mt_srand();
- ASCII 码中的删除控制字符(0x7F) 不再被支持
- 为 error_log 增加  syslog 类型
- 在不完整的对象上不再调用析构方法
- call_user_func()不再支持对传址的函数的调用 
- 字符串不再支持空索引操作符
- 以下ini配置项被移除
    - session.entropy_file
    - session.entropy_length
    - session.hash_function
    - session.hash_bits_per_character
- 通过引用赋值数组，引用值发生了变化，数组会进行重排序
- 对数组排序时相等元素排序进行优化
- E_RECOVERABLE 错误的错误消息已经从“可捕获的致命错误”更改为“可恢复的致命错误”
- unserialize()的$options参数的allowed_classes现在是严格类型的
- Datetime支持微秒
- Fatal errors 和 Error exceptions 之间的转换
- 词法绑定的变量不能重用名称
- JSON encoding 和 decoding 对于空元素的优化
- mb_ereg() 和 mb_eregi()参数修改
- 不再支持 sslv2 信息流
- 
- [文档](https://secure.php.net/manual/zh/migration71.incompatible.php)


#### PHP5.6 - PHP7.0
##### 新特新
- 标量类型声明。强制 (默认) 和 严格模式。
- 返回类型声明。
- null合并运算符 `??`
- 太空船操作符。用于比较两个表达式
- define() 定义常量数组
- 通过 `new class` 实例化一个匿名类
- Unicode codepoint 转译语法
- `Closure::call()`性能提升
- 为unserialize()提供过滤
- 新增加的 IntlChar 类旨在暴露出更多的 ICU 功能。这个类自身定义了许多静态方法用于操作多字符集的 unicode 字符。
- Expectations
- 批量use
- 生成器可以返回表达式
- 生成器委托。现在，只需在最外层生成其中使用 yield from， 就可以把一个生成器自动委派给其他的生成器， Traversable 对象或者 array。
- 整数除法函数 intdiv()
- session_start() 可以接受一个 array 作为参数， 用来覆盖 php.ini 文件中设置的 会话配置选项。
- 新增 preg_replace_callback_array()
- 新加入两个跨平台的函数： random_bytes() 和 random_int() 用来产生高安全级别的随机字符串和随机整数。
- 可以使用 list() 函数来展开实现了 ArrayAccess 接口的对象
- 允许在克隆表达式上访问对象成员
- [文档](https://secure.php.net/manual/zh/migration70.new-features.php)

##### 废除特性
- PHP4 风格的构造函数（方法名和类名一样）将被弃用，并在将来移除。
- 废弃了 静态（Static） 调用未声明成 static 的方法，未来可能会彻底移除该功能。
- 废弃了 password_hash() 函数中的盐值选项，阻止开发者生成自己的盐值（通常更不安全）。开发者不传该值时，该函数自己会生成密码学安全的盐值。因此再无必要传入自己自定义的盐值。
- 废弃了 capture_session_meta 内的 SSL 上下文选项。 现在可以通过 stream_get_meta_data() 获取 SSL 元数据（metadata）。
- 废弃了 ldap_sort() 函数
- [文档](https://secure.php.net/manual/zh/migration70.deprecated.php)

#### PHP5.5 - PHP5.6
##### 新特性
- 表达式定义常量,数组定义常量
- 使用 `...` 运算符实现变长参数函数 和 参数展开
- 使用 `**` 进行幂运算， 同时支持简写 `**=`
- use 运算符 被进行了扩展以支持在类中导入外部的函数和常量。 对应的结构为 use function 和 use const。
- PHP 的 SAPI 模块中实现了一个 交互式调试器，叫做 phpdbg。 [文档](https://phpdbg.room11.org/)
- 对于一些字符编码相关的函数，例如 htmlentities()， html_entity_decode() 以及 htmlspecialchars() 使用 default_charset 作为默认字符集。请注意，对于 iconv（现已废弃） 和 mbstring 相关的函数， 如果分别设置了他们的编码， 那么这些对应设置的优先级高于 default_charset。 default_charset 默认为UTF-8。
- php://input可重用
- 支持大于2GB的文件上传
- GMP支持运算符重载
- 使用hash_equals()比较字符串避免时序攻击
- 加入 __debugInfo()， 当使用 var_dump() 输出对象的时候， 可以用来控制要输出的属性和值。
- 加入 gost-crypto 散列算法。
- 提升对SSL/TLS支持
- pgsql异步支持
- [文档](https://secure.php.net/manual/zh/migration56.new-features.php)

##### 废弃特性
- 从不兼容的上下文调用方法
- $HTTP_RAW_POST_DATA 和 always_populate_raw_post_data
- iconv 和 mbstring 编码设置

#### PHP5.4 - PHP5.5
##### 新特性
- 新增：生成器(Generators) 关键字 yield
- 新增：关键字 finally
- empty() 支持传入表达式
- 数组和字符串可以直接访问指定下标（array and string literal dereferencing）
- 新的密码哈希API password_hash()
- 改进GD
    - 翻转支持使用新的 imageflip() 函数。
    - 高级裁剪支持使用 imagecrop() & imagecropauto() 函数。
    - WebP 的读写分别支持使用 imagecreatefromwebp() & imagewebp() 。
- [文档](https://secure.php.net/manual/zh/migration55.new-features.php)

##### 废弃特性
- 原始的 MySQL 扩展 现在被废弃，当连接到数据库时会产生一个 E_DEPRECATED 错误。可使用 MySQLi 或 PDO_MySQL 扩展作为替代
- 弃用preg_replace() 中的 /e 修饰符
- IntlDateFormatter::setTimeZoneID() 和 datefmt_set_timezone_id() 现在被废弃。可分别使用 IntlDateFormatter::setTimeZone() 方法和 datefmt_set_timezone() 函数作为替代。
- mcrypt 中废弃以下函数
    - mcrypt_cbc()
    - mcrypt_cfb()
    - mcrypt_ecb()
    - mcrypt_ofb()
- [文档](https://secure.php.net/manual/zh/migration55.deprecated.php)
