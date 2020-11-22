<?php

/*
// --------------------------------------------------------------------------
composer require ravisorg/exec-parallel
https://github.com/ravisorg/ExecParallel
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
MIT License

Copyright (c) 2017 ravisorg

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

/*

{{-- 原始 : hahaha --}}
{{-- 維護 :  --}}
{{-- 指揮 :  --}}
{{-- ---------------------------------------------------------------------------------------------- --}}
{{-- 決定 : name --}}
{{-- 
    ----------------------------------------------------------------------------
    說明 : 
    ----------------------------------------------------------------------------   
    
    ----------------------------------------------------------------------------
--}}
{{-- ---------------------------------------------------------------------------------------------- --}}
*/

namespace hahahalib\command;

/*
平行的Command
// --------------------------------------------------------------------------
注意 : 原來的\ExecParallel\Job有Bug，job complete前要readPipes一次，不然stdout會漏掉
// --------------------------------------------------------------------------
// 用法
$command_ = \hahahalib\command\hahaha_command_ravisorg::Instance()->Initial();
//$command_->Block = \hahahalib\command\hahaha_command_ravisorg::CONSTANT_PARALLEL;
$command_->Add('php ./test_command/a.php', [
    'stdout' => function($job, $output) { var_dump($output);print "\n"; },
]);
$command_->Add('php ./test_command/b.php', [
    'stdout' => function($job, $output) { var_dump($output);print "\n"; },
]);
$command_->Wait();
*/
class hahaha_command_ravisorg
{
    use \hahahalib\hahaha_instance_trait;

    public $Task_Controller_ = NULL;

    const CONSTANT_SEQUENCE = 0;
    const CONSTANT_PARALLEL = 1;

    public $Controller_Events_ = [];

    // --------------------------------------------------------------------------
    // Property    
    // --------------------------------------------------------------------------
    public $Block = self::CONSTANT_SEQUENCE;
    // --------------------------------------------------------------------------
    //     
    // --------------------------------------------------------------------------

    function __construct()
    {

    }

    /*
    */
    public function Initial($events = [])
    {
        $this->Task_Controller_ = new \ExecParallel\Controller();     
        
        $this->Controller_Events_ = $events;
        if(!empty($events['start']))
        {
            $this->Task_Controller_->on('start', $events['start']);
        }
        if(!empty($events['complete']))
        {
            $this->Task_Controller_->on('complete', $events['complete']);
        } 

        return $this; 
    }

    public function Add($command, $events = [])
    {
        $task_ = new \hahahalib\Extend\ExecParallel\Job();
        $task_->command = $command;

        if(!empty($events['start']))
        {
            $task_->on('start', $events['start']);
        }
        if(!empty($events['stdout']))
        {
            $task_->on('stdout', $events['stdout']);
        }
        if(!empty($events['stderr']))
        {
            $task_->on('stderr', $events['stderr']);
        }
        if(!empty($events['complete']))
        {
            $task_->on('complete', $events['complete']);
        }
                
        $this->Task_Controller_->addJob($task_);

        if($this->Block == self::CONSTANT_SEQUENCE)
        {
            $this->Task_Controller_->waitUntilComplete();
            // 重置
            $this->Task_Controller_ = new \ExecParallel\Controller();    
            if(!empty($this->Controller_Events_['start']))
            {
                $this->Task_Controller_->on('start', $this->Controller_Events_['start']);
            }
            if(!empty($this->Controller_Events_['complete']))
            {
                $this->Task_Controller__->on('complete', $this->Controller_Events_['complete']);
            } 
        }
    }

    /*
    平行時要用
    */
    public function Wait()
    {
        if($this->Block == self::CONSTANT_PARALLEL)
        {            
            $this->Task_Controller_->waitUntilComplete();
            // 重置
            $this->Task_Controller_ = new \ExecParallel\Controller();   
            if(!empty($this->Controller_Events_['start']))
            {
                $this->Task_Controller_->on('start', $this->Controller_Events_['start']);
            }
            if(!empty($this->Controller_Events_['complete']))
            {
                $this->Task_Controller__->on('complete', $this->Controller_Events_['complete']);
            }  
        }
    }
}