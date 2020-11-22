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
composer require "swiftmailer/swiftmailer:^6.0"
https://github.com/swiftmailer/swiftmailer
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

namespace hahahalib\email;



/*
我不是要Wrapper他，只是用來快速初始化
要wrapper成模組，請另外做，不過我覺得意義不大，它本身就是做好的模組了
*/
class hahaha_email_swift_mailler
{
    use \hahahalib\hahaha_instance_trait;
    
    public $Mailler_ = NULL;

    function __construct()
    {
       
    }

    public function Initial()
    {
        return $this;   
    }

    public function Initial_Gmail()
    {
        // 大概這樣做，我有用到才要做
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
        ->setUsername('your username')
        ->setPassword('your password')        ;

        // Create the Mailer using your created Transport
        $this->Mailler_ = new Swift_Mailer($transport);

        return $this;   
    }

	
	
}