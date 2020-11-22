<?php

/*
// --------------------------------------------------------------------------
注意
// --------------------------------------------------------------------------
沒 Opcache 小慢，請不要為了省力，摻入主要架構
// --------------------------------------------------------------------------
*/

/*
// --------------------------------------------------------------------------
composer require monolog/monolog
https://github.com/Seldaek/monolog
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
Copyright (c) 2011-2019 Jordi Boggiano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
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

namespace hahahalib;


use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;


/*
由於Monolog組合太多，所以沒辦法弄死
目的不是要打包Monolog，而是提供寫好的設定，讓使用的人可以直接拿來用
如果要自己寫，可以在外面直接用Monolog處理，再決定要不要整進來

如果寫好的設定太多，用Trait將其分開整理
*/
class hahaha_log
{
	use \hahahalib\hahaha_instance_trait;
	
    public $Root_ = NULL;

    public $Logger_ = NULL;

    function __construct()
    {
        $this->Root_ = realpath(__DIR__.'/../../../../logs');
    }

    public function Initial()
    {

    }

	/*
	不一定要寫成接口，也可以用system_setting or option，會比較乾淨
	*/
    public function Initial_Base($file = 'base.log',
        $channel = 'default', 
        $type = Logger::DEBUG
    )
    {
        $this->Logger_ = new Logger($channel);
        // 由於整進框架，因此root為logs/
        $this->Logger_->pushHandler(new StreamHandler($this->Root_ . '/' . $file, $type));

        return $this->Logger_;
	}
	
	public function Error($message, $context = [])
	{
		if(empty($this->Logger_))
		{
			return;
		}

		$this->Logger_->Error($message, $context);
    }
    
    /*
	其他的同error方法做
	*/
	
}