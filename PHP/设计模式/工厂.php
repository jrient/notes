<?php

/**
 * 工厂方法 主要用于实现多态
 * 对于已存在的工厂想要实现扩展，只需要继承 db实现一个基础的连接实例，并创建一个新的工厂即可
 */

interface db
{
    function conn();
}

class mysql implements db 
{
    public function conn() {
        echo 'mysql connect success';
    }
}

class sqlite implements db
{
    public function conn(){
        echo 'sqlite connect success';
    }
}

interface factory
{
    function createDb();
}

class mysqlFactory implements factory
{
    public function createDb()
    {
        return new mysql();
    }
}

class sqliteFactory implements factory
{
    public function createDb()
    {
        return new sqlite();
    }
}

