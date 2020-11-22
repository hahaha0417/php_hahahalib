<?php

namespace hahahalib;

/*
使用請加入
use \hahahalib\hahaha_class_instance_handle_trait;
public static $Class_Name_ = "\hahaha\hahaha_application";
*/
trait hahaha_class_instance_handle_trait_lite
{
	public static $Hanele_Lite_ = NULL;

	/*
	因為怕改很多次，所以函式化
	不會沒事去釋放物件，所以用函式可以接受
	*/
	public static function Examine_Lite()
	{
		return self::$Hanele_Lite_ && self::$Class_Name_Lite_::$Instance_ && self::$Hanele_Lite_ === self::$Class_Name_Lite_::$Instance_;
	}
	
	/*
	因為怕改很多次，所以函式化
	不會沒事去釋放物件，所以用函式可以接受
	*/
	public static function Instance_Lite()
	{
		self::$Hanele_Lite_ = self::$Class_Name_Lite_::Instance();
	}
	
	/*
	取得Handle
	*/
	public static function Lite()
	{
		if(empty(self::Examine_Lite()))
		{
			self::Instance_Lite();
		}
		
		return self::$Hanele_Lite_;
	}
	
	/*
	初始化
	*/
	public static function Initial_Lite()
	{
		if(empty(self::Examine_Lite()))
		{
			self::Instance_Lite();
		}
		
		self::$Hanele_Lite_->Initial();
	}

	/*
	釋放單例
	*/
	public static function Release_Lite()
	{
		if(!empty(self::Examine_Lite()))
		{
			self::$Class_Name_Lite_::Release();
			self::$Hanele_Lite_ = NULL;
		}
	}
	
}
