<?php

namespace hahahalib;

/*
使用請加入
use \hahahalib\hahaha_class_instance_handle_trait;
public static $Class_Name_ = "\hahaha\hahaha_application";
*/
trait hahaha_class_instance_handle_trait_http
{
	public static $Hanele_Http_ = NULL;
	
	/*
	因為怕改很多次，所以函式化
	不會沒事去釋放物件，所以用函式可以接受
	*/
	public static function Examine()
	{
		return self::$Hanele_Http_ && self::$Class_Name_::$Instance_ && self::$Hanele_Http_ === self::$Class_Name_::$Instance_;
	}
	
	/*
	因為怕改很多次，所以函式化
	不會沒事去釋放物件，所以用函式可以接受
	*/
	public static function Instance()
	{
		self::$Hanele_Http_ = self::$Class_Name_::Instance();
	}
	
	/*
	取得Handle
	*/
	public static function Get_Http()
	{
		if(empty(self::Examine()))
		{
			self::Instance();
		}
		
		return self::$Hanele_Http_;
	}
	
	/*
	初始化
	*/
	public static function Initial()
	{
		if(empty(self::Examine()))
		{
			self::Instance();
		}
		
		self::$Hanele_Http_->Initial();
	}

	/*
	釋放單例
	*/
	public static function Release()
	{
		if(!empty(self::Examine()))
		{
			self::$Class_Name_::Release();
			self::$Hanele_Http_ = NULL;
		}
	}
	
}
