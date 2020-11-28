<?php

/*
 * 原始 : hahaha
 * 維護 : 
 * 指揮 : 
 * ---------------------------------------------------------------------------- 
 * 決定 : name
 * ----------------------------------------------------------------------------
 * 說明 : 
 * ----------------------------------------------------------------------------   
    
 * ----------------------------------------------------------------------------

*/

namespace hahahalib;

/*

*/
class hahaha_db_mysql_function{
	use \hahahalib\hahaha_instance_trait;
	
    //-----------------------------------------------------------

    //-----------------------------------------------------------
    function __construct() {
		
	}
	
	function __destruct() {
		
    }
	
	/*
	找資料庫
	*/
	public function Find_Db_Databases(&$mysql, &$mysql_result, &$result, &$table_schema = "%%")
	{
		// 要比較用like %%
		$result_temp_ = $mysql->Query("SELECT * FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='{$table_schema}'");
		if($result_temp_)
		{
			$mysql_result->Fetch_All($result_temp_, $result);
		}
		
	}

	/*
	找資料表
	*/
	public function Find_Db_Tables(&$mysql, &$mysql_result, &$result, &$table_schema = "%%", &$table_name = "%%")
	{
		// 要比較用like %%
		$result_temp_ = $mysql->Query("SELECT * FROM information_schema.`COLUMNS` WHERE TABLE_SCHEMA='{$table_schema}' AND TABLE_NAME = '{$table_name}'");
		if($result_temp_)
		{
			$mysql_result->Fetch_All($result_temp_, $result);
		}
		
	}

}