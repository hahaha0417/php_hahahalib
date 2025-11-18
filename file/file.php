<?php

namespace hahahalib;


class file
{
    use \hahahalib\instance;

    // 刪除整個資料夾
    public function Delete_Tree($dir) 
    {
        if(!is_dir($dir))
        {
            return false;
        }
        $files = scandir($dir);

        foreach ($files as $key => &$value) 
        {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                unlink($path);
            } else if ($value != "." && $value != "..") {
                $this->Delete_Tree($path);
                rmdir($path);
            }
        }

        if(is_dir($dir))
        {
            rmdir($dir);
        }

        return true;
    }

    // 取得所有資料夾和檔案
    public function Get_Directory_And_File_All($dir, &$results = []) 
    {
        if(!is_dir($dir))
        {
            return false;
        }
        $files = scandir($dir);

        foreach ($files as $key => &$value) 
        {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->Get_Directory_And_File_All($path, $results);
                $results[] = $path;
            }
        }

        return true;
    }

    // 取得所有目錄
    public function Get_Directory_All($dir, &$results = [], $recursive = true) 
    {
        if(!is_dir($dir))
        {
            return false;
        }
        $files = scandir($dir);

        foreach ($files as $key => &$value) 
        {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                // $results[] = $path;
            } else if ($value != "." && $value != "..") {
                if($recursive)
                {
                    $this->Get_Directory_All($path, $results);
                }
                
                $results[] = $path;
            }
        }

        return true;
    }

    // 取得所有檔案
    public function Get_File_All($dir, &$results = [], $recursive = true) 
    {
        if(!is_dir($dir))
        {
            return false;
        }
        $files = scandir($dir);

        foreach ($files as $key => &$value) 
        {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                if($recursive)
                {
                    $this->Get_File_All($path, $results);
                }
                
                // $results[] = $path;
            }
        }

        return true;
    }
} 