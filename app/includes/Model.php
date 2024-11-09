<?php

trait Model
{//traits are better than classes since they do not need to be instantiated

    use Database; //using the Database trait
    //sql specifiers
    //protected $limit = 10;
    //protected $offset = 0;
    protected $orderBy = "desc";


    //dyamically creating and executing sql queries based on the model(in /app/models) used 

    public function findAll() //return multiple rows
    {
        $query = "select * from $this->table order by " . lcfirst($this->table) . "ID" . " $this->orderBy;";
        
        return $this->query($query);
    }

    public function where($data, $data_not = []) //return multiple rows
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = 'select * from ' . $this->table . ' where ';

        foreach ($keys as $key) {
            $query .= $key . ' = :' . $key . ' && ';
        }

        foreach ($keys_not as $key) {
            $query .= $key . ' != :' . $key . ' && ';
        }

        $query = rtrim($query, ' && ');
        //$query .= " order by " . lcfirst($this->table) . "ID" . " $this->orderBy";// offset $this->offset";

        $data = array_merge($data, $data_not);

        //show($this->query($query, $data));
        return $this->query($query, $data);
    }

    public function first($data, $data_not = []) //return 1 row
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM [{$this->table}] WHERE [";

        foreach ($keys as $key) {
            $query .= $key . '] = :' . $key . ' && [';
        }

        foreach ($keys_not as $key) {
            $query .= $key . ' != :' . $key . ' && [';
        }

        $query = rtrim($query, ' && [');
        //$query .= " limit $this->limit offset $this->offset";

        //echo "\n Query: ".$query."\n"; // <<<<<<<<<<<<<<<<<<<<<<

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }


    public function insert($data) //insert data into the table
    {
        $keys = array_keys($data);

        // Enclose keys in brackets to handle reserved keywords
        $bracketedKeys = array_map(function ($key) {
            return "[" . $key . "]";
        }, $keys);

        // Build the query
        $query = "INSERT INTO [{$this->table}] (" . implode(",", $bracketedKeys) . ") VALUES (:" . implode(",:", $keys) . ")";

        return $this->query($query, $data);
    }

    public function update($id, $data, $id_column = 'id') //update data in the table
    {
        $keys = array_keys($data);
        $query = "UPDATE [{$this->table}] set ";

        foreach ($keys as $key) {
            $query .= "[{$key}] = :{$key}, ";
        }

        $query = rtrim($query, ', ');
        $query .= " WHERE [{$id_column}] = $id";
        //show($query);

        if ($this->query($query, $data)) {
            return true;
        }
        return false;
    }

    public function delete($id, $id_column = 'id') //delete data from the table
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";

        if ($this->query($query, $data)) {
            return true;
        }
        return false;
    }


}