<?php

namespace System\Core;


use PDO;
use Exception;

class Database
{

    public $server;
    public $username;
    public $password;
    public $db_name;
    public $port;

    protected $conn;

    function __construct()
    {
        $this->server = env('DB_SERVER');
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');
        $this->db_name = env('DB_NAME');
        $this->port = env('DB_PORT');

        if (!empty($this->db_name)) $this->connect();
    }

    function connect()
    {
        $dsn = "mysql:host={$this->server};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
        $this->conn = new PDO($dsn, $this->username, $this->password);
    }

    public function __call($method, $args)
    {
        return $this->call($method, $args);
    }

    public static function __callStatic($method, $args)
    {
        return (new static())->call($method, $args);
    }

    private function call($method, $args)
    {
        if (! method_exists($this , '_' . $method)) {
            throw new Exception('Call undefined method ' . $method);
        }

        return $this->{'_' . $method}(...$args);
    }
    
}
