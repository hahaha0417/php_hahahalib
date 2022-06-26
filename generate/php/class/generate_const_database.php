<?php

namespace hahahalib;

/*

use hahahalib\generate_const_database as generate_const_database;

*/


class generate_const_database
{
    use \hahahalib\instance;

  
    public function Initial()
    {
        return $this;

    }

    public function Generate($file, $database, $namespace, $class)
    {
        $content = [];
        
        $content[] = "<?php";
        $content[] = "";
        $content[] = "namespace {$namespace};";
        $content[] = "";

        $content[] = "";
        $content[] = "/*";
        $content[] = "";
        foreach($database as $key => &$item) 
        {
            $t = strtoupper($item);
            $content[] = "use {$namespace}\\{$item} as {$item};";
            
        }
        $content[] = "";
        foreach($database as $key => &$item) 
        {
            $t = strtoupper($item);
            $content[] = "use {$namespace}\\{$item} as define_{$item};";
            
        }
        $content[] = "";
        
        $content[] = "*/";
        $content[] = "";
        
        $content[] = "class {$class}";
        $content[] = "{";
        foreach($database as $key => &$item) 
        {
            $t = strtoupper($item);
            $content[] = "\tconst {$t} = \"{$item}\";";

        }
        $content[] = "";
        $content[] = "}";
        $content[] = "";
        $content[] = "";

        // 其他附加
        $content[] = "";
        $content[] = "/*";
        $content[] = "";
        $content[] = "// 其他附加---------------------------------------------------------- ";
        $content[] = "";
        $content[] = "*/";
        $content[] = "";

        // ------------------------------------------------------- 
        // 有需要才附加寫成function
        // -------------------------------------------------------
        $this->addition($content);
        // -------------------------------------------------------
        
        file_put_contents($file, implode("\r\n", $content));
        opcache_invalidate($file, true);
    }

    // ------------------------------------------------------- 
    // 附加區
    // -------------------------------------------------------
    public function addition(&$content) 
    {        
        // 繼承出去修改，太多沒意義不要加在這,

    }
    // ------------------------------------------------------- 
    // 
    // -------------------------------------------------------

    // ------------------------------------------------------- 
    // 
    // -------------------------------------------------------
}