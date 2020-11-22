<?php

namespace hahahalib;

// 目前還沒有用到，先放著
class hahaha_parser_url
{
	use \hahahalib\hahaha_instance_trait;
	
	public $Tokens_ = [];
	
	public $Parameters_ = [];
	
	function __construct()
	{
		
	}	
	
	/*
	由於php 沒有const &，基於萬用接口，所以沒辦法reference
	*/
	public function Parse($url)
	{
		
	}
	
}