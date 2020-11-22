<?php

namespace hahahalib;

trait hahaha_instance_trait
{
	public static $Instance_ = NULL;
	
	/*
	單例模式
	https://www.php.net/manual/en/language.types.object.php
	object assign是reference
	*/
	public static function Instance()
	{
		if(!self::$Instance_) 
		{
			// new self可以少複製string
			// 單例，預設不initial
			self::$Instance_ = new self(false);
		}
		
		return self::$Instance_;
	}
	
	/*
	釋放單例
	*/
	public static function Release()
	{
		if(self::$Instance_) 
		{
			self::$Instance_ = NULL;
		}
	}
	
}
