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
$db_hahaha = new \hahahalib\hahaha_db_mysql;
$db_hahaha->Connect("localhost", "root", "hahaha", "hahaha");
$db_hahaha->Set_Names("utf8");
{
    $user = $db_hahaha->Query("select * from user");

    while ($row = $user->fetch_row()) {
        //printf ("%s (%s)\n<br>", $row[0], $row[1]);
    }
}

// 參數式
{
    $no = "0";
    $db_hahaha->Query_Parameter(
        "select id from user where no>=?",
        ["s"],
        [$no]
    );

    $name_ = "";
    $db_hahaha->Query_Parameter_Bind_Result(    
        [&$name_]
    );
    $db_hahaha->Query_Parameter_Bind_Result_Fetch();
    //echo $name_;
    $db_hahaha->Query_Parameter_Bind_Result_Fetch();
    //echo $name_;
    $db_hahaha->Query_Parameter_Close();
}
$br = "<br>";
echo "{$br}";
{
    $no = "0";
    $db_hahaha->Query_Parameter(
        "select * from user where no>=?",
        ["s"],
        [$no]
    );
    //var_dump($db_hahaha->Query_Parameter_Fetch_All());
    $db_hahaha->Query_Parameter_Close();
}

$db_hahaha->Close();

*/
class hahaha_db_mysql{
	use \hahahalib\hahaha_instance_trait;
	
    //-----------------------------------------------------------
    public $Mysqli_;
    public $Stmt_;
    //-----------------------------------------------------------
    public $Host_;
    public $User_;
    public $Password_;
    public $Database_;
    
    //-----------------------------------------------------------
    function __construct() {
		
	}
	
	function __destruct() {
		
    }

    public function Connect($host, $user, $password, $database){
        $this->Host_ = $host;
        $this->User_ = $user;
        $this->Password_ = $password;
        $this->Database_ = $database;
        $this->Mysqli_ = new \mysqli($host, $user, $password, $database);        
    
    }

    public function Close(){
        $this->Mysqli_->close();    
    }

    public function Set_Names($encode){
        $this->Mysqli_->query("SET NAMES ".$encode);
    }

    // $row = mysql_fetch_row($result);
    /*
    mysql_fetch_array() - Fetch a result row as an associative array, a numeric array, or both
    mysql_fetch_assoc() - Fetch a result row as an associative array
    mysql_fetch_object() - Fetch a result row as an object
    mysql_data_seek() - Move internal result pointer
    mysql_fetch_lengths() - Get the length of each output in a result
    mysql_result() - Get result data
    */
    public function Query($sql){        
        return $this->Mysqli_->query($sql);    
    }

    // $sql : eq : "INSERT INTO `users` (name, mail, home, message) VALUES (?, ?, ?, ?)";
    //  $type : array , eq : eq : {"i", "s", "s", "s"}
    /*
        i	corresponding variable has type integer
        d	corresponding variable has type double
        s	corresponding variable has type string
        b   corresponding variable is a blob and will be sent in packets
    */
    // $parameter : array , eq : {$name, $mail, $home, $message}
    // 參數不可為空
    // 好像?只能在where的地方
    public function Query_Parameter($sql, $type, $parameter){
        $this->Stmt_ = $this->Mysqli_->prepare($sql);   

        if(count($type) != count($parameter)){
            return -1;  // 參數數量不對
        }
        
        $type_ = "";
        foreach($type as $i => $value){
            $type_ .= $value;
        }

        // 準備10組，通常參數不會超過20個
        switch(count($parameter)){
            case 0:
                $this->Stmt_->bind_param($type_);
                break;
            case 1:
                $this->Stmt_->bind_param($type_,
                    $parameter[0]
                );
            break;
            case 2:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1]
                );
            break;
            case 3:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2]
                );
            break;
            case 4:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3]
                );
            break;
            case 5:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4]
                );
            break;
            case 6:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5]
                );
            break;
            case 7:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6]
                );
            break;
            case 8:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7]
                );
            break;
            case 9:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8]
                );
            break;
            case 10:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9]
                );
            break;
            case 11:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10]
                );
            break;
            case 12:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11]
                );
                break;
            case 13:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12]
                );
                break;
            case 14:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13]
                );
                break;
            case 15:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14]
                );
                break;
            case 16:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15]
                );
                break;
            case 17:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16]
                );
                break;
            case 18:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17]
                );
                break;
            case 19:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17],
                    $parameter[18]
                );
                break;
            case 20:
                $this->Stmt_->bind_param($type_,
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17],
                    $parameter[18],
                    $parameter[19]
                );
                break;
        }

        $this->Stmt_->execute();

        
    }
    
    // Query_Parameter_Result搭配Query_Parameter_Result_Fetch
    // 參數不可為空
    public function Query_Parameter_Bind_Result($parameter){        
        
        // 準備10組，通常參數不會超過20個
        switch(count($parameter)){
            case 0:
                $this->Stmt_->bind_result();
                break;
            case 1:
                $this->Stmt_->bind_result(
                    $parameter[0]
                );
            break;
            case 2:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1]
                );
            break;
            case 3:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2]
                );
            break;
            case 4:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3]
                );
            break;
            case 5:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4]
                );
            break;
            case 6:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5]
                );
            break;
            case 7:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6]
                );
            break;
            case 8:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7]
                );
            break;
            case 9:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8]
                );
            break;
            case 10:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9]
                );
            break;
            case 11:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10]
                );
            break;
            case 12:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11]
                );
                break;
            case 13:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12]
                );
                break;
            case 14:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13]
                );
                break;
            case 15:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14]
                );
                break;
            case 16:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15]
                );
                break;
            case 17:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16]
                );
                break;
            case 18:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17]
                );
                break;
            case 19:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17],
                    $parameter[18]
                );
                break;
            case 20:
                $this->Stmt_->bind_result(
                    $parameter[0],
                    $parameter[1],
                    $parameter[2],
                    $parameter[3],
                    $parameter[4],
                    $parameter[5],
                    $parameter[6],
                    $parameter[7],
                    $parameter[8],
                    $parameter[9],
                    $parameter[10],
                    $parameter[11],
                    $parameter[12],
                    $parameter[13],
                    $parameter[14],
                    $parameter[15],
                    $parameter[16],
                    $parameter[17],
                    $parameter[18],
                    $parameter[19]
                );
                break;
        }
        
    }

    // return 0 是空
    public function Query_Parameter_Bind_Result_Fetch(){
        return $this->Stmt_->fetch();        
    }

    // 單獨用
    public function Query_Parameter_Fetch_All(){    
        // 全取轉換
        $result = $this->Stmt_->get_result();
        $r = array();
        while ($data = $result->fetch_assoc())
        {
            $r[] = $data;
        }
        return $r;
    }

    public function Query_Parameter_Close(){
        $this->Stmt_->close();    
    }    


}