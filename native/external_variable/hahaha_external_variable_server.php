<?php

namespace hahahalib\external;

// https://www.php.net/manual/en/reserved.variables.server.php
class hahaha_external_variable_server
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
			"Redirect_Mibdirs" => "REDIRECT_MIBDIRS",
			"Redirect_Mysql_Home" => "REDIRECT_MYSQL_HOME",
			"Redirect_Openssl_Conf" => "REDIRECT_OPENSSL_CONF",
			"Redirect_Php_Pear_Sysconf_Dir" => "REDIRECT_PHP_PEAR_SYSCONF_DIR",
			"Redirect_Phprc" => "REDIRECT_PHPRC",
			"Redirect_Tmp" => "REDIRECT_TMP",
			"Redirect_Status" => "REDIRECT_STATUS",
			"Mibdirs" => "MIBDIRS",
			"Mysql_Home" => "MYSQL_HOME",
			"Openssl_Conf" => "OPENSSL_CONF",
			"Php_Pear_Sysconf_Dir" => "PHP_PEAR_SYSCONF_DIR",
			"Phprc" => "PHPRC",
			"Tmp" => "TMP",
			"Http_Host" => "HTTP_HOST",
			"Http_Connection" => "HTTP_CONNECTION",
			"Http_Cache_Control" => "HTTP_CACHE_CONTROL",
			"Http_Upgrade_Insecure_Requests" => "HTTP_UPGRADE_INSECURE_REQUESTS",
			"Http_User_Agent" => "HTTP_USER_AGENT",
			"Http_Sec_Fetch_Mode" => "HTTP_SEC_FETCH_MODE",
			"Http_Sec_Fetch_User" => "HTTP_SEC_FETCH_USER",
			"Http_Accept" => "HTTP_ACCEPT",
			"Http_Sec_Fetch_Site" => "HTTP_SEC_FETCH_SITE",
			"Http_Accept_Encoding" => "HTTP_ACCEPT_ENCODING",
			"Http_Accept_Language" => "HTTP_ACCEPT_LANGUAGE",
			"Http_Cookie" => "HTTP_COOKIE",
			"Path" => "PATH",
			"Systemroot" => "SystemRoot",
			"Comspec" => "COMSPEC",
			"Pathext" => "PATHEXT",
			"Windir" => "WINDIR",
			"Server_Signature" => "SERVER_SIGNATURE",
			"Server_Software" => "SERVER_SOFTWARE",
			"Server_Name" => "SERVER_NAME",
			"Server_Addr" => "SERVER_ADDR",
			"Server_Port" => "SERVER_PORT",
			"Remote_Addr" => "REMOTE_ADDR",
			"Document_Root" => "DOCUMENT_ROOT",
			"Request_Scheme" => "REQUEST_SCHEME",
			"Context_Prefix" => "CONTEXT_PREFIX",
			"Context_Document_Root" => "CONTEXT_DOCUMENT_ROOT",
			"Server_Admin" => "SERVER_ADMIN",
			"Script_Filename" => "SCRIPT_FILENAME",
			"Remote_Port" => "REMOTE_PORT",
			"Redirect_Url" => "REDIRECT_URL",
			"Gateway_Interface" => "GATEWAY_INTERFACE",
			"Server_Protocol" => "SERVER_PROTOCOL",
			"Request_Method" => "REQUEST_METHOD",
			"Query_String" => "QUERY_STRING",
			"Request_Uri" => "REQUEST_URI",
			"Script_Name" => "SCRIPT_NAME",
			"Php_Self" => "PHP_SELF",
			"Request_Time_Float" => "REQUEST_TIME_FLOAT",
			"Request_Time" => "REQUEST_TIME",
			//
			"https" => "HTTPS",
			"http_x_forwarded_proto" => "HTTP_X_FORWARDED_PROTO"
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
		if ( (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') || 
			(! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || 
			(! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') 
		) 
		{
			return false;
		} else 
		{
			return true;
		}
	}
	
	public function Is_Https()
	{
		if ( (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') || 
			(! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || 
			(! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') 
		) 
		{
			return true;
		} else 
		{
			return false;
		}
	}
	
}