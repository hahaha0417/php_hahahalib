<?php

namespace hahahalib;

use hahahalib\function\key as function_key;
use hahaha\config\database as config_database;
use hahaha\config\orm_doctrine as config_orm_doctrine;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// https://gist.github.com/roggeo/3cd2f3ffc894f9fb2b9851952a76fe4d

/*

use hahahalib\orm_doctrine as orm_doctrine;

*/

/*
http://note.drx.tw/2012/12/mysql-syntax.html
*/
class orm_doctrine
{
    use \hahahalib\instance;

    public $Entity_Manager = null;


    public function Initial()
    {
        
        $config_database = config_database::instance();
        $config_doctrine = config_orm_doctrine::instance();

        $host = $config_database->host;
        $port = $config_database->port;
        $name = $config_database->name;
        $user = $config_database->user;
        $password = $config_database->password;
        $charset = $config_database->charset;
        $path = $config_doctrine->entity->path;

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $paths = [$path];
        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

        // database configuration parameters
        $conn = [
            'driver'    => 'pdo_mysql',
            'host'      => $host,
            'port'      => $port,
            'user'      => $user,
            'password'  => $password,
            'dbname'    => $name,
            'charset'   => $charset,
            'driverOptions' => [
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]
        ];

        //資料庫連線
        try {
            $entity_manager = EntityManager::create($conn, $config);
            
            $this->Entity_Manager = $entity_manager;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        return $this;

    }

    public function Initial_Pdo_Mysql(
        $host,
        $port,
        $name,
        $user,
        $password,
        $charset,
        $path 
    )
    {
        
        $config_database = config_database::instance();

        $host = $config_database->host;
        $port = $config_database->port;
        $name = $config_database->name;
        $user = $config_database->user;
        $password = $config_database->password;
        $charset = $config_database->charset;

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $paths = [$path];
        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

        // database configuration parameters
        $conn = [
            'driver'    => 'pdo_mysql',
            'host'      => $host,
            'port'      => $port,
            'user'      => $user,
            'password'  => $password,
            'dbname'    => $name,
            'charset'   => $charset,
            'driverOptions' => [
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]
        ];

        //資料庫連線
        try {
            $entity_manager = EntityManager::create($conn, $config);
            
            $this->Entity_Manager = $entity_manager;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        return $this;

    }

    public function Set_Query_Cache_PHP()
    {
        $cache = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter('doctrine_queries');
        $config = new \Doctrine\ORM\Configuration();
        $config->setQueryCache($cache);
    }

    /*
    要手動設定
    */
    public function Set_Result_Cache_PHP(
        $namespace = 'doctrine_results',
        $path = '/path/to/writable/directory')
    {
        $cache = new \Symfony\Component\Cache\Adapter\PhpFilesAdapter(
            $namespace,
            0,
            $path
        );
        $config = new \Doctrine\ORM\Configuration();
        $config->setResultCache($cache);
    }

    // -----------------------------------------------------
    // base
    // -----------------------------------------------------

    // -----------------------------------------------------

    // -----------------------------------------------------
}