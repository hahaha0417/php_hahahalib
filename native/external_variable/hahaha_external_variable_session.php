<?php

namespace hahahalib\external;

class hahaha_external_variable_session
{
	use \hahahalib\hahaha_instance_trait;

	function __construct()
	{
		// 確保只啟動一次
		\hahahalib\hahaha_function_session::Start();
		
	}	
	
	/*
	沒找到才會呼叫這個，如果已經有變數，則不會再進來
	有用到才設定
	*/
	public function __get($name)
	{		
		// 存referencer就好，避免複製記憶體
		if(!empty($_SESSION[$name]))
		{
			$this->$name = &$_SESSION[$name];
		}
		else
		{
			return NULL;
		}
		
		return $this->$name;
	}

	/*
	寫入Sesssion
	*/
	public function __set($name, $value)
	{		
		if(!$value)
		{
			unset($_SESSION[$name]);	
		}
		else
		{
			$_SESSION[$name] = $value;	
		}
			
	}



	
}