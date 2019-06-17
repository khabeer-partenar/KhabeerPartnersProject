<?php

namespace Modules\Core\Traits;

trait SharedModel
{
    /**
    * Return Table Name
    */
    public static function table()
    {
        return with(new static)->getTable();
    }
    
}
