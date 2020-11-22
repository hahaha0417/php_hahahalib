<?php

/*
// --------------------------------------------------------------------------
注意
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
*/

/*
// --------------------------------------------------------------------------
composer require tijsverkoyen/css-to-inline-styles
https://github.com/tijsverkoyen/CssToInlineStyles
Licene BSD 3-Clause
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*
Copyright (c) Tijs Verkoyen. All rights reserved. Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, 
THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, 
EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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

namespace hahahalib\css;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/*
將HTML & CSS合併
*/
class hahaha_css_css_to_inline_styles
{
    use \hahahalib\hahaha_instance_trait;
    
    public $Css_To_Inline_Styles_ = NULL;

    function __construct()
    {
        $this->Css_To_Inline_Styles_ = new CssToInlineStyles();
    }

    public function Initial()
    {
        return $this;   
    }

    /*
    $csses 多個css
    */
    public function Convert($html, $csses = [])
    {
        $html = file_get_contents($html);
     
        $result_ = $html;

        foreach($csses as &$css)
        {
            $css = file_get_contents($css);
            $result_ = $this->Css_To_Inline_Styles_->convert(
                $result_,
                $css
            );
        }

        return $result_;
    }

	
	
}