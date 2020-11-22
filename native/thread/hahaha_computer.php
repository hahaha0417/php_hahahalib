<?php

namespace hahahalib;

// http://www.01happy.com/php-thread-introduction/

// https://windows.php.net/downloads/
// https://windows.php.net/downloads/pecl/snaps/pthreads/

// https://github.com/krakjoe/pthreads/releases/tag/v3.0.6

// pthread限制只可用於CLI版本
// https://github.com/krakjoe/pthreads

// 沒使用過，請小心

/*
//这里创建线程池.
$pool = array(new \hahahalib\computer('a'), new \hahahalib\computer('b'), new \hahahalib\computer('c'));
 
//启动所有线程,使其处于工作状态
foreach ($pool as $w) {
    $w->start();
}
 
//派发任务给线程
for ($i = 0; $i < 10; $i++) {
    $params = rand(10, 99);
    while (true) {
        foreach ($pool as $worker) {
            //参数为空则说明线程空闲
            if (is_null($worker->params)) {
                $worker->params = $params;
                echo "({$worker->id})线程空闲,放入参数{$params}.\n";
                break 2;
            }
        }
        sleep(1);
    }
}
 
//关闭线程
while (count($pool)) {
    //遍历检查线程组运行结束
    foreach ($pool as $key => $worker) {
        if ($worker->params == '') {
            echo "({$worker->id})线程运行完成,退出.\n";
            //设置结束标志
            $worker->runing = false;
            unset($pool[$key]);
        }
    }
    echo "等待退出中...\n";
    sleep(1);
}
 
echo "退出成功\n";
*/
class hahaha_computer extends \Thread {
 
    public $Id_;
    public $Runing_ = false;
    public $Params_ = null;
 
    public function __construct($id) {
        $this->Id_     = $id;
        $this->Runing_ = true;
    }
 
    public function run() {
        while ($this->Runing_) {
            if (is_null($this->Params_)) {
                echo "线程({$this->Id_})等待任务...\n";
            } else {
                echo "线程({$this->Id_}) 收到任务参数::{$this->Params_}.\n";
                $this->Params_ = null;
            }
            sleep(1);
        }
    }
 
}