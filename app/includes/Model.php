<?php

class Model
{
    use Database; //using the Database trait

    protected $table = 'User';
    protected $limit = 10;
    protected $offset = 0;

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
        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = []) //return 1 row
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where";

        foreach ($keys as $key) {
            $query .= $key . ' = :' . $key . ' && ';
        }

        foreach ($keys_not as $key) {
            $query .= $key . ' != :' . $key . ' && ';
        }

        $query = rtrim($query, ' && ');
        $query .= " limit $this->limit offset $this->offset";

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
        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $this->query($query, $data);
    }

    public function update($id, $data, $id_column = 'id')
    {

    }

    public function delete($id, $id_column = 'id')
    {

    }
}