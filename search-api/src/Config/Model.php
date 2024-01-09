<?php

namespace App\Config;

abstract class Model
{

    static protected $database = null;

    public function __construct()
    {
        // If $database is not initialised yet, does it
        if (self::$database === null) {
            self::$database = new Database();
        }
    }
}
