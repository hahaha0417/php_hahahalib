<?php

namespace hahahalib;

trait instance
{
    public static $Instance = null;

    public static function Instance() 
    {
        if(self::$Instance == null) 
        {
            self::$Instance = new self;

        }
        return self::$Instance;
    }




}