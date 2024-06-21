<?php

interface DB
{
    function connect(): void;
    function execute();
}

class Mysql implements DB
{
    function connect(): void
    {
    }

    function execute()
    {
    }
}

interface DBFactory
{
    function createDB(): DB;
}

class MysqlFactory implements DBFactory
{
    function createDB(): DB
    {
        return new Mysql;
    }
}


class Client
{

    protected DB $db;

    // And also you can inject ClientService there
    public function __construct()
    {
        $this->getDB(new MysqlFactory);
    }

    function getDB(DBFactory $factory)
    {
        $this->db = $factory->createDB();
        $this->db->connect();
    }

    function operation(): void
    {
        $this->db->execute();
    }
}
