<?php

namespace hahahalib\command;

class migrate
{
    use \hahahalib\instance;

    public $File_Artisan_;

    public function Initial($file_artisan)
    {
        $this->File_Artisan_ = $file_artisan;

        return $this;

    }

    public function Migrate(&$database, 
        &$file_name
    )
    {
        $command = "php \"{$this->File_Artisan_}\" migrate --database={$database} --path={$file_name}";

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

    public function Rollback(&$database, 
        &$file_name
    )
    {
        $command = "php \"{$this->File_Artisan_}\" migrate:rollback --database={$database} --path={$file_name}";

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