<?php

namespace hahahalib\external;

class hahaha_external_variable_arg
{
	use \hahahalib\hahaha_instance_trait;
	
	public static $Mapping_List_ = NULL;
	
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
			'Count' => "argc",
			'Arg' => "argv",
		];	
	}
	
}