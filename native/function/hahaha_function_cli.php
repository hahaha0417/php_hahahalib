<?php

namespace hahahalib;

class hahaha_function_cli
{
	/*
	https://www.binarytides.com/php-check-running-cli/
	*/
	public static function Is_Cli()
	{
		if( defined('STDIN') )
		{
			return true;
		}
		
		if( empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) == 0) 
		{
			return true;
		} 
		
		return false;
	}
} 

