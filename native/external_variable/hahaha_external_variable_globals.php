<?php

namespace hahahalib\external;

class hahaha_external_variable_globals
{
	use \hahahalib\hahaha_instance_trait;
	
	public static $Mapping_List_ = NULL;
	
	//public $host;
	function __construct()
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
				$this->$name = &$GLOBALS[self::$Mapping_List_[$name]];
			}
			else
			{
				$variable = &$GLOBALS[$name];
				if(isset($variable))
				{
					$this->$name = $variable;
				}
				else
				{
					throw new \Exception("沒有hahaha_web_server變數$" . $name);
				}
			}
		}
		
		return $this->$name;
	}
	
	public function Get_Mapping()
	{
		// Mapping $_GLOBALS
		self::$Mapping_List_ = [
			'Get' => "_GET",
			'Post' => "_POST",
			'Cookie' => "_COOKIE",
			'Files' => "_FILES",
			'Server' => "_SERVER",
			'Request' => "_REQUEST",
			'Global' => "GLOBALS",
		];	
	}
	
}