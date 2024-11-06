<?php

class ModLog
{
    use Model; // Use the Model trait

    protected $table = 'ModLog'; //when using the Model trait, this table name ise used 

    public function getAllTables()
    {
        $query = "SELECT name FROM sys.tables where name!= 'sysdiagrams' ORDER BY name;";
        return $this->query(query: $query);
    }
}
