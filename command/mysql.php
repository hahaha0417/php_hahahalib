<?php

namespace hahahalib\command;

class mysql
{
    use \hahahalib\instance;

    public $Exe_Mysql_;
    public $Host_;
    public $Port_;
    public $User_;
    public $Password_;


    public function Initial(&$exe_mysql, 
        &$host,
        &$port,
        &$user,
        &$password
    )
    {
        $this->Exe_Mysql_ = $exe_mysql;
        $this->Host_ = $host;
        $this->Port_ = $port;
        $this->User_ = $user;
        $this->Password_ = $password;
      
        return $this;

    }

    // file_name SQL
    public function Import(&$database,
        &$file_name
    )
    {
        $command = sprintf(
            '"%s" --host=%s --port=%s --user=%s --password=%s %s < "%s"',
            $this->Exe_Mysql_,
            $this->Host_,
            $this->Port_,
            $this->User_,
            $this->Password_,
            $database,
            $file_name
        );
      
        $output = [];
        $result = [];

        // 執行
        exec($command, $output, $result);

        // 檢查狀態
        // 檢查結果
        if ($result === 0) {
            return true;
        } else {
            return false;
        }

    }

    // -----------------------------------------------------
    // base
    // -----------------------------------------------------

    // -----------------------------------------------------

    // -----------------------------------------------------
}