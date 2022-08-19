# Traits

## 介绍
Trait 是为类似 PHP 的单继承语言而准备的一种代码复用机制。Trait 为了减少单继承语言的限制，使开发人员能够自由地在不同层次结构内独立的类中复用 method。

> 版本要求 ： php5.4以上

## 使用

### 单继承

```php
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
```

### 多继承

```php
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
```


### 解决冲突

通过在use的时候使用`insteadof`关键词来指定使用的是哪一个类中的方法

```php
<?php
trait Game
{
    function play() {
        echo "Playing a game";
    }
}

trait Music
{
    function play() {
        echo "Playing music";
    }
}

class Player
{
    use Game, Music {
        // 指定play 使用的是Music中的play
        Music::play insteadof Game;
    }
}

$player = new Player();
$player->play();
```

### 优先顺序

1. trait 的方法覆盖从父类继承的方法
2. 当前类定义的方法覆盖 trait 的方法