<?php

/*
// --------------------------------------------------------------------------
注意
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
*/

/*
// --------------------------------------------------------------------------
composer require phpmailer/phpmailer
https://github.com/PHPMailer/PHPMailer
Licene LGPL
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
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
class hahaha_email_php_mailler
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
        /*
        // Instantiation and passing `true` enables exceptions
        $this->Mailler_ = new PHPMailer(true);

        //Server settings
        $this->Mailler_->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $this->Mailler_->isSMTP();                                            // Send using SMTP
        $this->Mailler_->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
        $this->Mailler_->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->Mailler_->Username   = 'user@example.com';                     // SMTP username
        $this->Mailler_->Password   = 'secret';                               // SMTP password
        $this->Mailler_->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $this->Mailler_->Port       = 587;                                    // TCP port to connect to
        */      
        return $this;                           
    }

	
	
}