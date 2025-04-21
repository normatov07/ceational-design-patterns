<?php


interface Database
{

}

class Mysql implements Database
{
    protected static $conn;

    private function __construct()
    {
        if (!isset(self::$conn)) {
            self::$conn = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        }

        return self::$conn;
    }

    public function connect(): void
    {
        $this->__construct();
    }

}