<?php

/*
facebook/php-graph-sdk 二次開發
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

namespace hahahalib\facebook;

class hahaha_facebook
{
    use \hahahalib\hahaha_instance_trait;


    public $Facebook_ = NULL;

    function __construct()
    {       
    }

    /** \Facebook\Facebook
     * 
     */
    public function Initial($app_id, 
        $app_secret,
        $default_graph_version = 'v4.0'
    )
    {
        $this->Facebook_ = new \Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        return $this;
    }


}