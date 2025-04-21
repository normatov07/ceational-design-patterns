<?php


interface Database
{
    public static function getInstance(): self;
}

class Mysql implements Database
{
    protected static Mysql $instance;
    private PDO $connection;
    

    private function __construct()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Mysql();
            self::$instance->connect();
        }

        return self::$instance;
    }

    public static function getInstance(): self
    {
        return self::__construct();
    }

    private function connect(): void
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    }

}


// Client implementation
class Post {
    protected Database $database;

    public function __construct()
    {       
        $this->database = Mysql::getInstance();
    }
}
