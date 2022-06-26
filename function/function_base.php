<?php

namespace hahahalib;

use hahahalib\function\key as function_key;

/*

use hahahalib\function_base as function_base;

*/


class function_base
{
    use \hahahalib\instance;

    /*
        PHP判断当前协议是否为HTTPS

        https://blog.csdn.net/haibo0668/article/details/81113133

    */
	public function Is_Https() {
	    if ( !empty($_SERVER[function_key::HTTPS]) && strtolower($_SERVER[function_key::HTTPS]) !== function_key::OFF) {
	        return true;
	    } elseif ( isset($_SERVER[function_key::HTTP_X_FORWARDED_PROTO]) && $_SERVER[function_key::HTTP_X_FORWARDED_PROTO] === function_key::HTTPS ) {
	        return true;
	    } elseif ( !empty($_SERVER[function_key::HTTP_FRONT_END_HTTPS]) && strtolower($_SERVER[function_key::HTTP_FRONT_END_HTTPS]) !== function_key::OFF) {
	        return true;
	    }
	    return false;

	}

    /*
        PHP判断当前协议是否为HTTPS

        https://blog.csdn.net/haibo0668/article/details/81113133

    */
	public function Is_Http() {
	    if ( !empty($_SERVER[function_key::HTTPS]) && strtolower($_SERVER[function_key::HTTPS]) !== function_key::OFF) {
	        return false;
	    } elseif ( isset($_SERVER[function_key::HTTP_X_FORWARDED_PROTO]) && $_SERVER[function_key::HTTP_X_FORWARDED_PROTO] === function_key::HTTPS ) {
	        return false;
	    } elseif ( !empty($_SERVER[function_key::HTTP_FRONT_END_HTTPS]) && strtolower($_SERVER[function_key::HTTP_FRONT_END_HTTPS]) !== function_key::OFF) {
	        return false;
	    }
	    return true;

	}

    /*
        是否為Console模式

        https://www.puritys.me/docs-blog/article-241-PHP-%E5%88%A4%E6%96%B7%E6%98%AF%E5%90%A6%E7%82%BA-Command-Line-%E7%9A%84%E6%96%B9%E5%BC%8F.html

    */
	public function Is_Cli()
    {
        if (PHP_SAPI != function_key::CLI) 
        {
            return false;
        } 
        return true;

    }

	/*

	是否為Get

	*/
	public function Is_Get()
	{
		return isset($_SERVER[function_key::REQUEST_METHOD]) && 
			strtoupper($_SERVER[function_key::REQUEST_METHOD]) == function_key::GET;

	}

	/*

	是否為Post
	
	*/
	public function Is_Post()
	{
		return isset($_SERVER[function_key::REQUEST_METHOD]) && 
			strtoupper($_SERVER[function_key::REQUEST_METHOD]) == function_key::POST;

	}


	


}