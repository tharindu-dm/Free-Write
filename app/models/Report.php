<?php

class Report
{
  use Model; 

  protected $table = 'Report';  
  protected $dateTimeColumn = 'submitTime';
  
  public function getAllReports($limit, $offset)
  {
    $query = "SELECT * FROM Report";

    return $this->query($query);
  }
}
