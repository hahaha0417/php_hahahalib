<?php

namespace hahahalib\command;

class _7_zip
{
    use \hahahalib\instance;

    public $Exe_7_Zip_;
    
    public function Initial(&$exe_7_zip, 
    )
    {
        $this->Exe_7_Zip_ = $exe_7_zip;
        
        return $this;

    }

    // file_name SQL
    public function Zip(&$file_name,
        &$items
    )
    {
        // 建立命令（避免密碼暴露，記得引號！）
        $command = sprintf(
            '"%s" a %s ',
            $this->Exe_7_Zip_,
            $file_name
        );

        foreach($items as $key => &$item)
        {
            $command .= "\"{$items[$key]}\" ";
        }
      
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

    // file_name SQL
    public function Un_Zip(&$file_name,
        &$dir_output
    )
    {
        // 建立命令（避免密碼暴露，記得引號！）
        $command = sprintf(
            '"%s" x "%s" -o"%s"',
            $this->Exe_7_Zip_,
            $file_name,
            $dir_output
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