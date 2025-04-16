<?php

class SiteLog
{
    use Model; // Use the Model trait

    protected $table = 'SiteLog'; //when using the Model trait, this table name ise used 

    public function todayLogs()
    {
        $query = "SELECT *
                FROM [dbo].[SiteLog]
                WHERE occurrence >= CAST(CAST(GETDATE() AS DATE) AS DATETIME)
                AND occurrence < DATEADD(DAY, 1, CAST(CAST(GETDATE() AS DATE) AS DATETIME));";

        return $this->query($query);
    }
}
