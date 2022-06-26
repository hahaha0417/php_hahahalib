<?php

namespace hahahalib;

/*

use hahahalib\generate_const_table as generate_const_table;

*/


class generate_const_table
{
    use \hahahalib\instance;

    public function Initial()
    {
        return $this;
        
    }
 
    public function Generate($file, $tables, $namespace)
    {
        $content = [];
        
        
        foreach($tables as $key_table => &$item_table) 
        {
            $content[] = "<?php";
            $content[] = "";
            $content[] = "namespace {$namespace};";
            $content[] = "";

            $content[] = "";
            $content[] = "/*";
            $content[] = "";
            $content[] = "use {$namespace}\\{$key_table} as {$key_table};";
            $content[] = "use {$namespace}\\{$key_table} as define_{$key_table};";
                
            $content[] = "";
            
            $content[] = "*/";
            $content[] = "";
            
            
            $content[] = "class {$key_table}";
            $content[] = "{";
            foreach($item_table as $key => &$item) 
            {
                $content[] = "\t// \"{$item['comment']}\";";
                $t = strtoupper($item['field']);
                $content[] = "\tconst {$t} = \"{$item['field']}\";";
    
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
            $this->addition($content, $key_table, $item_table);
            // -------------------------------------------------------

            $file_table = $file . "/{$key_table}.php"; 
            
            file_put_contents($file_table, implode("\r\n", $content));
            opcache_invalidate($file_table, true);



            unset($content);
        }
        
    }

    // ------------------------------------------------------- 
    // 附加區
    // -------------------------------------------------------
    public function addition(&$content, $key_table, $item_table) 
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