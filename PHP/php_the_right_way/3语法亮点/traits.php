<?php

# 单继承
print_r('### 单继承'."\n");

Trait Singleton
{
    private static $instance;

    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

class DbReader
{
    use Singleton;
}

class  FileReader
{
    use Singleton;
}


$a = DbReader::getInstance();
$b = FileReader::getInstance();
var_dump($a);  //object(DbReader)
var_dump($b);  //object(FileReader)


# 多继承
print_r('### 多继承'."\n");

trait Hello
{
    function sayHello() {
        echo "Hello";
    }
}

trait World
{
    function sayWorld() {
        echo "World";
    }
}

class MyWorld
{
    use Hello, World;
}

$world = new MyWorld();
echo $world->sayHello() . " " . $world->sayWorld(); //Hello World