<?php

namespace hahahalib\external;

// 用getenv替代，一樣分完整和lite版
// https://www.php.net/manual/en/function.getenv.php
// https://blog.csdn.net/zhezhebie/article/details/72734590
class hahaha_external_variable_env
{
	use \hahahalib\hahaha_instance_trait;
	
	public static $Mapping_List_ = NULL;
	
	//public $host;
	function __construct()
	{

		
	}	
	
	/*
	由於php 沒有const &，基於萬用接口，所以沒辦法reference
	*/
	public function Parse($url)
	{
		
	}
	
	/*
	沒找到才會呼叫這個，如果已經有變數，則不會再進來
	有用到才設定
	*/
	public function __get($name)
	{
		// 有用到才初始對應表
		if(!self::$Mapping_List_)
		{
			$this->Get_Mapping();
		}
	
		// 存referencer就好，避免複製記憶體
		if(empty($this->$name))
		{
			if(!empty(self::$Mapping_List_[$name]))
			{
				$this->$name = &$_SERVER[self::$Mapping_List_[$name]];
			}
			else
			{
				throw new \Exception("沒有hahaha_web_server變數$" . $name);
			}
		}
		
		return $this->$name;
	}
	
	public function Get_Mapping()
	{
		// Mapping $_SERVER
		self::$Mapping_List_ = [
			'host' => "REQUEST_URI"
		];	
	}
	
}