<?php

namespace hahahalib;

trait instance_clear
{
    public static $Instance_ = null;

    public static function Instance()
    {
        if (self::$Instance_ == null) {
            self::$Instance_ = new self;

        }

        return self::$Instance_;
    }

    public function Clear()
    {
        foreach (array_keys(get_object_vars($this)) as $property_) {
            unset($this->{$property_});
        }

        return $this;
    }
}
