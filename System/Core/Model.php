<?php

namespace System\Core;

use PDO;

class Model extends Database
{

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
        $this->query['table'] = $table;
        return $this;
    }

    function select($data)
    {
        $temp = 'SELECT ';
        if (is_string($data)) {
            $this->query['select'] = 'SELECT ' . $data . ' FROM ';
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

    function like($title, $match, $position = 'both'){
        if($position == 'before') {
            $match = "'{$match}%'";
        } elseif($position == 'after') {
            $match = "'%{$match}'";
        } else {
            $match = "'%{$match}%'";
        }
        $this->query['like'] = " WHERE {$title} LIKE {$match}";
        return $this;
    }

    function update($column, $value = NULL)
    {
        $temp = '';
        if($value == NULL) {
            foreach($column as $key => $value){
                if($key == 'submit') continue;
                $temp .= $key . ' = \'' .  $value . '\'';
                if (next($column) == true) {
                    $temp .= ', ';
                }
            }
            $query = 'UPDATE ' . $this->query["table"] . ' SET ' . $temp . $this->query["where"];
        } else {
            $query = 'UPDATE ' . $this->query["table"] . ' SET ' . $column . '=\'' . $value . '\'' . $this->query["where"];
        }

        $this->query($query);
    }

    function orderBy($column = 'id', $type = 'ASC'){
        $this->query['orderby'] = " ORDER BY {$column} {$type}";
        return $this;
    }

    function insert($data)
    {
        $cols = '';
        $vals = '';
        foreach ($data as $key => $d) :
            if($key == 'submit') continue;
            $cols .= $key;
            $vals .= '\'' .  $d . '\'';
            if (next($data) == true) {
                $cols .= ',';
                $vals .= ',';
            }
        endforeach;
        
        $query = "INSERT INTO " . $this->query['table'] . ' ('.$cols.') VALUES ('.$vals.')';

        return $this->query($query);
    }

    function limit($count, $start = 0)
    {
        $this->query['limit'] = " LIMIT {$start}, {$count}";
        return $this;
    }

    function get()
    {
        $query = '';
        isset($this->query['select']) ? $query = $this->query['select'] : $query = 'SELECT * FROM ';
        isset($this->query['table']) ? $query .= $this->query['table'] : '';
        isset($this->query['where']) ? $query .= $this->query['where'] : '';
        isset($this->query['orderby']) ? $query .= $this->query['orderby'] : '';
        isset($this->query['limit']) ? $query .= $this->query['limit'] : '';
        isset($this->query['like']) ? $query .= $this->query['like'] : '';

        

        return $this->query($query)->fetchAll(PDO::FETCH_OBJ);
    }
}
