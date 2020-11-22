<?php

namespace hahahalib;

/*
Time Measure

link https://blog.longwin.com.tw/2006/02/php_test_get_microtime/
*/
class hahha_time
{
    protected $Start_ = 0;
    protected $End_ = 0;

    function __contruct()
    {

    }

    public function Start()
    {
        $this->start = microtime(true);
    }

    public function End()
    {
        $this->end = microtime(true);
    }

    /**
     * @return ms
     */
    public function Time()
    {        
        return ($this->end -$this->start) * 1000;
    }

}