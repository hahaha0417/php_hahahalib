<?php

namespace hahahalib\external;

class hahaha_external_variable_get
{
	use \hahahalib\hahaha_instance_trait;
	
	function __construct()
	{

		
	}	
	
	/*
	沒找到才會呼叫這個，如果已經有變數，則不會再進來
	有用到才設定
	*/
	public function __get($name)
	{
		// 存referencer就好，避免複製記憶體
		if(!empty($_GET[$name]))
		{
			$this->$name = &$_GET[$name];
		}
		else
		{
			throw new \Exception("沒有hahaha_web_get變數$" . $name);
		}
		
		return $this->$name;
	}

	
}