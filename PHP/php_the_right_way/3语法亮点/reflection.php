<?php

class User
        {
    public $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * 获取用户名
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * 设置用户名
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * 获取密码
     * @return string
     */
    private function getPassword()
    {
        return $this->password;
    }

    /**
     * 设置密码
     * @param string $password
     */
    private function setPassowrd($password)
    {
        $this->password = $password;
    }
}

# 创建反射类实例
$refClass = new ReflectionClass(new User('liulu', '123456'));
// 也可以写成
$refClass = new ReflectionClass('User'); // 将类名User作为参数，建立User类的反射类

# 反射属性
$properties = $refClass->getProperties(); // 获取User类的所有属性，返回ReflectionProperty的数组
var_dump($properties);
$property = $refClass->getProperty('password'); // 获取User类的password属性
var_dump($property);
//$properties 结果如下：
//Array (
//    [0] => ReflectionProperty Object ( [name] => username [class] => User )
//   [1] => ReflectionProperty Object ( [name] => password [class] => User )
//)
//$property 结果如下：
//ReflectionProperty Object ( [name] => password [class] => User )

# 反射方法
$methods = $refClass->getMethods(); // 获取User类的所有方法，返回ReflectionMethod数组
var_dump($methods);
$method = $refClass->getMethod('getUsername');  // 获取User类的getUsername方法
var_dump($method);
//$methods 结果如下：
//Array (
//    [0] => ReflectionMethod Object ( [name] => __construct [class] => User )
//    [1] => ReflectionMethod Object ( [name] => getUsername [class] => User )
//    [2] => ReflectionMethod Object ( [name] => setUsername [class] => User )
//    [3] => ReflectionMethod Object ( [name] => getPassword [class] => User )
//    [4] => ReflectionMethod Object ( [name] => setPassowrd [class] => User )
//)
////$method 结果如下：
//ReflectionMethod Object ( [name] => getUsername [class] => User )

# 反射注释
$classComment = $refClass->getDocComment();  // 获取User类的注释文档，即定义在类之前的注释
$methodComment = $refClass->getMethod('setPassowrd')->getDocComment();  // 获取User类中setPassowrd方法的注释
////$classComment 结果如下：
///** * 用户相关类 */
////$methodComment 结果如下：
///** * 设置密码 * @param string $password */

# 反射实例化
$instance = $refClass->newInstance('admin', 123, '***');  // 从指定的参数创建一个新的类实例
////$instance 结果如下：
//User Object ( [username] => admin [password:User:private] => 123 )
//注：虽然构造函数中是两个参数，但是newInstance方法接受可变数目的参数，用于传递到类的构造函数。
//
//$params = ['xiaoming', 'asdfg'];
//$instance = $refClass->newInstanceArgs($params); // 从给出的参数创建一个新的类实例
////$instance 结果如下：
//User Object ( [username] => xiaoming [password:User:private] => asdfg )

#访问、执行类的公有方法——public
$instance->setUsername('admin_1'); // 调用User类的实例调用setUsername方法设置用户名
$username = $instance->getUsername(); // 用过User类的实例调用getUsername方法获取用户名
echo $username . "\n"; // 输出 admin_1
// 也可以写成
$refClass->getProperty('username')->setValue($instance, 'admin_2'); // 通过反射类ReflectionProperty设置指定实例的username属性值
$username = $refClass->getProperty('username')->getValue($instance); // 通过反射类ReflectionProperty获取username的属性值
echo $username . "\n"; // 输出 admin_2
// 还可以写成
$refClass->getMethod('setUsername')->invoke($instance, 'admin_3'); // 通过反射类ReflectionMethod调用指定实例的方法，并且传送参数
$value = $refClass->getMethod('getUsername')->invoke($instance); // 通过反射类ReflectionMethod调用指定实例的方法
echo $value . "\n"; // 输出 admin_3

# 访问、执行类的非公有方法——private、protected
try {
    // 正确写法
    $property = $refClass->getProperty('password'); // ReflectionProperty Object ( [name] => password [class] => User )
    $property->setAccessible(true); // 修改 $property 对象的可访问性
    $property->setValue($instance, '987654321'); // 可以执行
    $value = $property->getValue($instance); // 可以执行
    echo $value . "\n";   // 输出 987654321

    // 错误写法
    $refClass->getProperty('password')->setAccessible(true); // 临时修改ReflectionProperty对象的可访问性
    $refClass->getProperty('password')->setValue($instance, 'password'); // 不能执行，抛出不能访问异常
    $refClass = $refClass->getProperty('password')->getValue($instance); // 不能执行，抛出不能访问异常
    $refClass = $instance->password;   // 不能执行，类本身的属性没有被修改，仍然是private
} catch (Exception $e){
    echo $e;
}

// 错误写法 结果如下：
//ReflectionException: Cannot access non-public member User::password in xxx.php