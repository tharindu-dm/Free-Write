<?php

class ModLog
{
    use Model; 

    protected $table = 'ModLog';  

    public function filterByDate($params, $date)
    {
        $date = DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        $query = "SELECT * FROM [ModLog] WHERE ";

        if (isset($params['user']))
            $query .= '[user] = ' . $params['user'];

        if (isset($params['modlogID']))
            $query .= '[modlogID] = ' . $params['modlogID'];

        $query .= " CAST([occurrence] AS DATE) = '" . $date . "'";

        return $this->query( $query);
    }
}
