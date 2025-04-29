<?php

class SiteLog
{
    use Model; 

    protected $table = 'SiteLog';  

    public function todayLogs()
    {
        $query = "SELECT *
                FROM [dbo].[SiteLog]
                WHERE occurrence >= CAST(CAST(GETDATE() AS DATE) AS DATETIME)
                AND occurrence < DATEADD(DAY, 1, CAST(CAST(GETDATE() AS DATE) AS DATETIME));";

        return $this->query($query);
    }

    public function filterByDate($params, $date)
    {
        $date = DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        $query = "SELECT * FROM [SiteLog] WHERE ";

        if (isset($params['user']))
            $query .= '[user] = ' . $params['user'];

        if (isset($params['siteLogID']))
            $query .= '[siteLogID] = ' . $params['siteLogID'];

        $query .= " CAST([occurrence] AS DATE) = '" . $date . "'";

        return $this->query( $query);
    }
}
