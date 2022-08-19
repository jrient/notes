<?php

/**
 * 单例主要作用于数据库连接
 * 在一次脚本执行过程中，一旦生成了一次连接，则不会再次创建
 * 减少了多次连接数据库的性能消耗
 */

class signer {
    protected static $ins = null;

    // 创建生成单例方法，将生成的实例赋值给self::$ins并将其暴露给客户端
    static public function getIns()
    {
        if (self::$ins === null) {
            self::$ins = new self;
        }
        return self::$ins;
    }

    // final 封锁继承， protected 禁止外部new
    final protected function __construct()
    {

    }

    // 封锁克隆
    final protected function __clone()
    {

    }
}