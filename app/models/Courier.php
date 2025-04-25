<?php

class Courier
{
    use Model; 

    protected $table = 'Courier'; 

    public function getCourierByAssignedDate()
{
    $query = "SELECT TOP 1 * FROM Courier 
              WHERE assignedDate IS NOT NULL 
              ORDER BY assignedDate ASC";
    return $this->query($query);
}

}
