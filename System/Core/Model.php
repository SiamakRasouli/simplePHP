<?php

namespace System\Core;

class Model extends Database {

    public $query = [];

    function __construct()
    {
        parent::__construct();
    }

    function query($query, $params = [])
    {
        $statement = $this->conn->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    function table($table = 'users')
    {
        $this->query['table'] = " FROM {$table}";
        return $this;
    }

    function select($data)
    {
        $temp = 'SELECT ';
        if (is_string($data)) {
            $this->query['select'] = 'SELECT ' . $data;
            return $this;
        }

        foreach ($data as $d) :
            $temp .= $d;
            if (next($data) == true) $temp .= ',';
        endforeach;
        $this->query['select'] = $temp;
        return $this;
    }

    function where($column, $value)
    {
        $this->query['where'] = " WHERE {$column} = {$value}";
        return $this;
    }

    function limit($count, $start = 0)
    {
        $this->query['limit'] = " LIMIT {$start}, {$count}";
        return $this;
    }

    function get()
    {
        $query = '';
        isset($this->query['select']) ? $query = $this->query['select']: '';
        isset($this->query['table']) ? $query .= $this->query['table']: '';
        isset($this->query['where']) ? $query .= $this->query['where']: '';
        isset($this->query['limit']) ? $query .= $this->query['limit']: '';

        return $this->query($query)->fetch();
    }

}