<?php

/*
// --------------------------------------------------------------------------
此模組只有Linux可以用
composer require christiaan/stream-process
https://github.com/christiaan/stream-process
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
Copyright (c) 2013 Christiaan Baartse

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
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
可Block的Command
stream_set_blocking 在Windows不可以用
所以這個模組在Windows不可以用
https://www.php.net/manual/en/function.stream-set-blocking.php
注意 : 因為我主要要給Windows用，所以用Windows的寫法


*/
class hahaha_command_christiaan
{
    use \hahahalib\hahaha_instance_trait;

    public $Loop_ = NULL;

    public $Tasks_ = [];



    // --------------------------------------------------------------------------
    // Property    
    // --------------------------------------------------------------------------

    // --------------------------------------------------------------------------
    // Property    
    // --------------------------------------------------------------------------

    function __construct()
    {

    }

    /*
    */
    public function Initial()
    {
        $this->Loop_ = \React\EventLoop\Factory::create();
        /*
        // 這在Windows不能用
        $this->Loop_->addPeriodicTimer(1, function() {
            \pcntl_signal_dispatch();
        });        
        \pcntl_signal(SIGTERM, function() use($loop) {
            $loop->stop();
            // Cleanup before closing
            exit(0);
        });
        */
                        
        return $this; 
    }

    public function Add($command, $block = false)
    {
        $task_ = new \Christiaan\StreamProcess\StreamProcess($command);
        $task_->setBlocking($block);
        $this->Tasks_[] = $task_;
        
        $this->Loop_->addReadStream($task_->getReadStream(), function($stream) {
            $data = fgets($stream);
            fwrite(STDOUT, $data);
        });
        
    }

    public function Run()
    {
        $this->Loop_->Run();
    }
}