<?php

trait Model
{
    use Database;
    protected $orderBy = "desc";

    public function findAll()
    {
        $query = "select * from [$this->table] order by [" . lcfirst($this->table) . "ID]" . " $this->orderBy;";

        return $this->query($query);
    }

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM [{$this->table}] WHERE [";

        foreach ($keys as $key) {
            $query .= $key . '] = :' . $key . ' AND [';
        }

        foreach ($keys_not as $key) {
            $query .= $key . '] != :' . $key . ' AND [';
        }

        $query = substr_replace($query, '', strrpos($query, ' AND ['), strlen(' AND ['));


        $data = array_merge($data, $data_not);


        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM [{$this->table}] WHERE [";

        foreach ($keys as $key) {
            $query .= $key . '] = :' . $key . ' AND [';
        }

        foreach ($keys_not as $key) {
            $query .= $key . '] != :' . $key . ' AND [';
        }

        $query = substr_replace($query, '', strrpos($query, ' AND ['), strlen(' AND ['));

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $keys = array_keys($data);


        $bracketedKeys = array_map(function ($key) {
            return "[" . $key . "]";
        }, $keys);


        $query = "INSERT INTO [{$this->table}] (" . implode(",", $bracketedKeys) . ") VALUES (:" . implode(",:", $keys) . ")";


        return $this->query($query, $data);
    }

    public function update($id, $data, $id_column = 'id')
    {
        $keys = array_keys($data);
        $query = "UPDATE [{$this->table}] set ";

        foreach ($keys as $key) {
            $query .= "[{$key}] = :{$key}, ";
        }

        $query = rtrim($query, ', ');
        $query .= " WHERE [{$id_column}] = $id";



        if ($this->query($query, $data)) {
            return true;
        }
        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM [{$this->table}] WHERE $id_column = :$id_column";

        if ($this->query($query, $data)) {
            return true;
        }
        return false;
    }

    public function getDetailsInDateRange($startDate, $endDate)
    {
        $query = "SELECT * FROM [{$this->table}] 
        WHERE 
        CAST([{$this->dateTimeColumn}] AS DATE) >= '$startDate' AND 
        CAST([{$this->dateTimeColumn}] AS DATE) <= '$endDate'";

        return $this->query($query);
    }
}