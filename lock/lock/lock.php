<?php

namespace hahahalib;

use hahaha\env;

// https://www.w3schools.com/php/func_filesystem_flock.asp
// https://www.google.com/search?q=%E9%8E%96+php&oq=%E9%8E%96+php&aqs=edge..69i57j0i8i30.7651j0j1&sourceid=chrome&ie=UTF-8
// 
// 簡單 - 阻塞式大鎖
class Lock
{
    use \hahahalib\instance;

    public $Lock_File;
    public $File;
    public $Handle;
    public $Retry_Time;

    function __construct() {
        // print "In constructor\n";

    }

    function __destruct() {
        // print "Destroying " . __CLASS__ . "\n";
        $this->Un_Lock();

    }
   
    public function Initial()
    {
       
        return $this;

    }

    public function Initial_Lock($lock_file, $retry_time = 500000)
    {
        $this->Lock_File = $lock_file;
        $this->Retry_Time = $retry_time;
        

        return $this;

    }

    public function Lock()
    {
        if(!file_exists($this->Lock_File)) 
        {
            $dir = dirname($this->Lock_File);
            
            if(!is_dir($dir)) 
            {
                mkdir($dir, 0777, true);
            }

            touch($this->Lock_File);
        }

        // https://www.php.net/manual/en/function.fopen.php
        // 'r+'	Open for reading and writing; place the file pointer at the beginning of the file.
        $this->Handle = fopen($this->Lock_File, 'r+');

        /* Activate the LOCK_NB option on an LOCK_EX operation */
        while(1) 
        {
            $result = flock($this->Handle, LOCK_EX | LOCK_NB);
            if(!$result)
            {
                usleep($this->Retry_Time);
                continue;
            }
            // echo 'Unable to obtain lock';
            // exit(-1);
            break;
        }

        return true;

    }

    public function Un_Lock()
    {
        if($this->Handle == null)
        {
            return false;
        }

        fclose($this->Handle);
        $this->Handle = null;
        return true;

    }

}