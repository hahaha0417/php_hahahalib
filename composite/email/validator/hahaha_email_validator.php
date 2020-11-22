<?php

/*
// --------------------------------------------------------------------------
注意
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
*/

/*
// --------------------------------------------------------------------------
composer require egulias/email-validator
https://github.com/egulias/EmailValidator
Licene MIT
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
Copyright (c) 2013-2016 Eduardo Gulias Davis

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

namespace hahahalib\email;

use Egulias\EmailValidator\EmailValidator;

use Egulias\EmailValidator\Validation\RFCValidation;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\SpoofCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;

/*

*/
class hahaha_email_validator
{
	use \hahahalib\hahaha_instance_trait;
    
    public $Validator_ = NULL;

    const RFCV = 0;
    const NoRFCWarnings = 1;
    const DNSCheck = 2;
    const SpoofCheck = 3;

    function __construct()
    {
        $this->Validator_ = new EmailValidator();
    }

    public function Initial()
    {
        return $this;   
    }

    /*
    可以用array回傳，但是這樣寫比較快
    */
    public function Valid($emails, &$successes, &$failures, $valids = [self::RFCV])
    {
        $result_ = true;

        $valids_ = [];
        foreach($valids as &$valid)
        {
            if($valid == self::RFCV)
            {
                $valids_ = new RFCValidation();
            }
            else if($valid == self::NoRFCWarnings)
            {
                $valids_ = new NoRFCWarningsValidation();
            }
            else if($valid == self::DNSCheck)
            {
                $valids_ = new DNSCheckValidation();
            }
            else if($valid == self::SpoofCheck)
            {
                $valids_ = new SpoofCheckValidation();
            }
        }

        $multiple_validations_ = new MultipleValidationWithAnd($valids_);

        foreach($emails as &$email)
        {
            $result_ &= $this->Validator_->isValid($email, $multiple_validations_);
        }

        return $result_;
    }
	
}