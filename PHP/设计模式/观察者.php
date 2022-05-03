<?php

class User implements SplSubject
{
    public $loginNum;
    public $hobby;

    protected $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function login()
    {
        $this->loginNum = rand(1, 10);
        $randHobbt = rand(0,1);
        $this->hobby = ['study', 'sport'][$randHobbt];

        $this->notify(); 
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        // 重置指针
        $this->observers->rewind();
        // 循环验证当前observer是否正常工作
        while($this->observers->valid()) {
            $observer = $this->observers->current();
            $observer->update($this);
            $this->observers->next();
        }
    }

}

/**
 * 安全模块 观察登录次数
 */
class Secrity implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        if ($subject->loginNum > 3) {
            echo "unsafe login:".$subject->loginNum;
        } else {
            echo "safe login";
        }
    }
}

/**
 * 广告模块 观察兴趣爱好
 */
class Ad implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        if ($subject->hobby == 'suports') {
            echo "suports";
        } else {
            echo "study";
        }
    }
}

//实施观察

$user = new User();
$user->attach(new Secrity());
$user->attach(new Ad());

$user->login();