<?php

namespace hahahalib;

use hahahalib\function\key as function_key;
use hahaha\config\database as config_database;
/*

use hahahalib\pdo as pdo;

*/

/*
http://note.drx.tw/2012/12/mysql-syntax.html
*/
class pdo
{
    use \hahahalib\instance;

    public $Pdo = null;

    public function Initial()
    {
        $config_database = config_database::instance();

        $host = $config_database->host;
        $port = $config_database->port;
        $name = $config_database->name;
        $user = $config_database->user;
        $password = $config_database->password;
        $charset = $config_database->charset;

        // PDO 連線設定
        $options = [
            \PDO::ATTR_PERSISTENT => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}"
        ];

        //資料庫連線
        try {
            $pdo = new \PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $password, $options);
            // $pdo->exec("SET CHARACTER SET {$charset}");
            $this->Pdo = $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        

    }

    public function Initial_Mysql(
        $host,
        $port,
        $name,
        $user,
        $password,
        $charset 
    )
    {
        // PDO 連線設定
        $options = [
            \PDO::ATTR_PERSISTENT => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}"
        ];

        //資料庫連線
        try {
            $pdo = new \PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $password, $options);
            // $pdo->exec("SET CHARACTER SET {$charset}");
            $this->Pdo = $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        

    }

    public function Close()
    {
        //關閉資料庫
        unset($this->Pdo);
        $this->Pdo = null;

    }

    public function Exec($sql)
    {
        $pdo = $this->Pdo;

        $result = $pdo->exec($sql);
        return $result;

    }

    /*

    */
    public function Query($sql, &$result, $parameter = [], $fetch = \PDO::FETCH_ASSOC)
    {
        $pdo = $this->Pdo;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($parameter);

        // https://codertw.com/%E7%A8%8B%E5%BC%8F%E8%AA%9E%E8%A8%80/210282/
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        // PDO::FETCH_ASSOC, 只會出現有key的一種
        // PDO::FETCH_ASSOC — 關聯陣列形式
        // PDO::FETCH_NUM — 數字索引陣列形式
        // PDO::FETCH_BOTH — 兩者陣列形式都有，這是預設的
        // PDO::FETCH_OBJ — 按照物件的形式，類似於以前的 mysql_fetch_object()
        // PDO::FETCH_BOUND–以布林值的形式返回結果，同時獲取的列值賦給bindParam()方法中的指定變數。
        // PDO::FETCH_LAZY–以關聯陣列、數字索引陣列和物件3種形式返回結果

        // 有要進階設計才弄上面
        // doctrine 2似乎是做好的
        $rows = $stmt->fetchAll($fetch);

        if($rows === false) 
        {
            return false;
        }

        // iterate over array by index and by name
        foreach($rows as $key => &$row) 
        {
            // 不用reference，避免修改rows異常
            $result[$key] = $rows[$key];
            
        }
        return true;

    }

    // -----------------------------------------------------
    // base
    // -----------------------------------------------------

    // ----------------------------
    // 新增單筆(insert)
    // ----------------------------
    // 因為專案寫法，不實作
    // @link https://gist.github.com/mikedfunk/76e28f5159f630392d8f
    // @link http://stackoverflow.com/questions/13507496/pdo-php-insert-into-db-from-an-associative-array
    public function Insert($table, $fields, $value, $where)
    {
        // @link https://gist.github.com/mikedfunk/76e28f5159f630392d8f
        // @link http://stackoverflow.com/questions/13507496/pdo-php-insert-into-db-from-an-associative-array
        //  $keys = array_keys($a);
        //  $sql = "INSERT INTO user (".implode(", ",$keys).") \n";
        //  $sql .= "VALUES ( :".implode(", :",$keys).")";        
        //  $q = $this->dbConnection->prepare($sql);
        //  return $q->execute($a);

        return true;

    }
    // ----------------------------
    // 新增多筆(insert)，後面多,
    // 因為專案寫法，不實作
    // https://www.sqlservertutorial.net/sql-server-basics/sql-server-insert-multiple-rows/
    // ----------------------------
    public function Insert_Multiple($table, $fields, $values, $where)
    {
        // @link https://gist.github.com/mikedfunk/76e28f5159f630392d8f
        // @link http://stackoverflow.com/questions/13507496/pdo-php-insert-into-db-from-an-associative-array
        //  $keys = array_keys($a);
        //  $sql = "INSERT INTO user (".implode(", ",$keys).") \n";
        //  $sql .= "VALUES ( :".implode(", :",$keys).")";        
        //  $q = $this->dbConnection->prepare($sql);
        //  return $q->execute($a);

    }
    // ----------------------------
    // 修改(update)
    // ----------------------------
    // 因為專案寫法，不實作
    
    // ----------------------------
    // 刪除(delete)
    // ----------------------------
    // 因為專案寫法，不實作

    // ----------------------------
    // 查詢(select)
    // ----------------------------
    // 同 query
    // ----------------------------
    // 
    // ----------------------------

    // -----------------------------------------------------
    // database
    // -----------------------------------------------------
    // 建立資料庫
    // ----------------------------
    public function Create_Database($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "create database {$name}";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 列出所有資料庫
    // ----------------------------
    public function Show_Databases()
    {
        $pdo = $this->Pdo;
        
        $sql = "show databases";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 資料庫是否存在
    // ----------------------------
    public function Is_Database($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$name}'";

        
        $rows = [];
        $this->Query($sql, $rows, [], \PDO::FETCH_BOTH);
        
        return count($rows) > 0;

    }


    // ----------------------------
    // 刪除資料庫
    // ----------------------------
    public function Drop_Database($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "drop database {$name}";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 使用資料庫
    // ----------------------------
    public function Use_Database($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "use {$name}";

        $result = $pdo->exec($sql);
        return $result;
    }

    // ----------------------------
    // 
    // ----------------------------

    // -----------------------------------------------------
    // table
    // -----------------------------------------------------

    // ----------------------------
    // 修改資料表名稱
    // ----------------------------
    // https://aa1218bb.pixnet.net/blog/post/12109430
    public function Alter_Table($old_name, $new_name)
    {
        $pdo = $this->Pdo;
        
        $sql = "alter table {$old_name} rename {$new_name}";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 更名資料表
    // ----------------------------
    // Rename_Table("a_db.old_table", "b_db.new_table");
    public function Rename_Table($old_name, $new_name)
    {
        $pdo = $this->Pdo;
        
        $sql = "rename table {$old_name} rename {$new_name}";

        $result = $pdo->exec($sql);
        return $result;

    }
    

    // ----------------------------
    // 刪除資料表
    // ----------------------------
    public function Drop_Table($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "drop table {$name}";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 清空資料表
    // ----------------------------
    public function Truncate_table($name)
    {
        $pdo = $this->Pdo;
        
        $sql = "truncate table {$name}";

        $result = $pdo->exec($sql);
        return $result;

    }

    // ----------------------------
    // 
    // ----------------------------

    // ----------------------------
    // 
    // ----------------------------

    // -----------------------------------------------------
    // 進階
    // -----------------------------------------------------

    // ----------------------------
    // 事務 開始
    // https://developer.aliyun.com/article/797828
    // for update 仅适用于InnoDB，并且必须开启事务，在begin与commit之间才生效
    // ----------------------------
    public function Transaction()
    {
        $pdo = $this->Pdo;
        
        $result = $pdo->beginTransaction();
        return $result;

    }

    // ----------------------------
    // 事務 提交
    // ----------------------------
    public function Commit()
    {
        $pdo = $this->Pdo;
        
        $result = $pdo->commit();
        return $result;

    }

    // ----------------------------
    // 事務 回滾
    // ----------------------------
    public function Rollback($name)
    {
        $pdo = $this->Pdo;
        
        $result = $pdo->rollBack();
        return $result;

    }

    // ----------------------------
    // 
    // ----------------------------
    // -----------------------------------------------------
    // 常用 - 固定
    // -----------------------------------------------------
    // 取得 database table
    public function Get_Tables($database, &$result)
    {
        $pdo = pdo::instance();

        $sql = "SHOW TABLES FROM {$database}";
    
        $rows = [];
        $pdo->Query($sql, $rows, [], \PDO::FETCH_BOTH);

        foreach($rows as $key => &$row)
        {
            $result[$row[0]] = $row[0];
        }

        return true;
    }

    // 取得資料表所有欄位
    public function Get_Table_Fields($database, $table, &$result)
    {
        $pdo = pdo::instance();

        $sql = "show full fields from `{$database}`.`{$table}`";

        $rows = [];
        $pdo->Query($sql, $rows);

        foreach($rows as $key => &$row)
        {
            if(!isset($result[$table])) {
                $result[$table] = [];
                continue;
            }
            if(!isset($row["Field"])) {
                continue;
            }
            $result[$table][$row["Field"]] = [
                "field" => $row["Field"],
                "comment" => $row["Comment"],
            ];

        }
        unset($rows);

        return true;
    }
  
    /*
    取得所有資料表的所有欄位
     
    SHOW FULL FIELDS FROM accounts
    https://fannys23.pixnet.net/blog/post/30008933
    */
    public function Get_Tables_Fields($database, &$tables, &$result)
    {
        $pdo = pdo::instance();

        foreach($tables as $key => $table)
        {
            $sql = "show full fields from `{$database}`.`{$table}`";

            $rows = [];
            $pdo->Query($sql, $rows);
    
            foreach($rows as $key => &$row)
            {
                // if(!isset($result[$table])) {
                //     $result[$table] = [];
                //     continue;
                // }
                if(!isset($row["Field"])) {
                    continue;
                }
                $result[$table][$row["Field"]] = [
                    "field" => $row["Field"],
                    "comment" => $row["Comment"],
                ];

            }
            unset($rows);
        }

        return true;
    }
    

    // -----------------------------------------------------
    // base
    // -----------------------------------------------------

    // -----------------------------------------------------

    // -----------------------------------------------------
}