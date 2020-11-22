<?php

namespace hahahalib\external;

class hahaha_external_variable_cookie
{
	use \hahahalib\hahaha_instance_trait;

	/*
	逾時
	*/
	public $Timeout_ = 3600;

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
		if(!empty($_COOKIE[$name]))
		{
			$this->$name = &$_COOKIE[$name];
		}
		else
		{
			throw new \Exception("沒有hahaha_web_cookie變數$" . $name);
		}
		
		return $this->$name;
	}

	/*
	寫入Cookie，
	Cookie會設到Client Browser，下回合才會好
	*/
	public function __set($name, $value)
	{	
		setcookie($name, $value, time() + $this->Timeout_);
	}
	
	// --------------------------------------------------------------------------
	// 實作部分
	// --------------------------------------------------------------------------
	// 不要做成屬性，因為變數不能卡到函式
	// --------------------------------------------------------------------------

	/*
	逾時(秒))
	*/
	public function Timeout($timeout)
	{
		$this->Timeout_ = $timeout;
	}

	/*
	過期
	*/
	public function Expire($name)
	{
		setcookie($name, '', time() - 3600);
	}

	/*
	還有路徑和網域...etc，有用到再加以後再加
	*/
	
}