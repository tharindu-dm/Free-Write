<?php

class Quotation
{
    use Model; 

    protected $table = 'Quotation';  

    public function getQuotaByID($qID)
    {
        $query = "SELECT 
            q.*,
            p.name AS publisher
        FROM 
            Quotation q
        LEFT JOIN Publisher p ON q.publisher = p.pubID
        WHERE 
            q.quotaID = :qID";

        $params = [':qID' => $qID];
        $result = $this->query($query, $params);

        if ($result) {
            return $result[0]; 
        } else {
            return null; 
        }
    }



    public function getQuotaByAuthor($uID)
    {
        $query = "SELECT 
            q.*,
            p.name AS publisher
        FROM 
            Quotation q
        LEFT JOIN Publisher p ON q.publisher = p.pubID
        WHERE 
            q.writer = :usrID";

        $params = [':usrID' => $uID];
        $result = $this->query($query, $params);

        if ($result) {
            return $result[0]; 
        } else {
            return null; 
        }
    }

}
