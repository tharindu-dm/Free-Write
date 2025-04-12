<?php

class Quotation
{
    use Model; // Use the Model trait

    protected $table = 'Quotation'; //when using the Model trait, this table name ise used 

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
            return $result[0]; // Return the first result if found
        } else {
            return null; // No results found
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
            return $result[0]; // Return the first result if found
        } else {
            return null; // No results found
        }
    }

}
