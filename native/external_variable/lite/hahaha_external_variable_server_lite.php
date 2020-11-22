<?php

namespace hahahalib\external\lite;

// https://www.php.net/manual/en/reserved.variables.server.php
class hahaha_external_variable_server_lite
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
	
	/*
	這沒辦法用if else or class多層解
	"Http_Accept" => "HTTP_ACCEPT",
	"Http_Accept_Encoding"
	這會打架
	
	其實這樣解法算已經夠快了，數量沒很多，散裂碰撞不會很嚴重
	如需要更快，則另外弄一個小的，將常用的初始化即可，如有特殊需求，在查大的，或直接用原始的撈(比較醜而已)
	不要做成，小表查完查不到查大表，那可能會變成查兩次，不如自己複製一份，你要查那些，將他放在表裡即可
	*/
	
	public function Get_Mapping()
	{	
		// Mapping $_SERVER
		self::$Mapping_List_ = [
			// 架構及常用表
			// 有需要可以繼承出去另外弄一個附加表，或是自己的表
			"Http_Host" => "HTTP_HOST",
			"Server_Name" => "SERVER_NAME",
			"Server_Addr" => "SERVER_ADDR",
			"Server_Port" => "SERVER_PORT",
			"Remote_Addr" => "REMOTE_ADDR",			
			"Request_Scheme" => "REQUEST_SCHEME",			
			"Remote_Port" => "REMOTE_PORT",
			"Redirect_Url" => "REDIRECT_URL",			
			"Server_Protocol" => "SERVER_PROTOCOL",
			"Request_Method" => "REQUEST_METHOD",
			"Request_Uri" => "REQUEST_URI",			
		];	
	}
	
	public function Is_Get()
	{
		return $this->Request_Method == 'GET';
	}
	
	public function Is_Post()
	{
		return $this->Request_Method == 'POST';
	}
	
	public function Is_Http()
	{
		return $this->Request_Scheme == 'http';
	}
	
	public function Is_Https()
	{
		return $this->Request_Scheme == 'https';
	}
	
}