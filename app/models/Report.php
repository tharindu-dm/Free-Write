<?php

class Report
{
  use Model; // Use the Model trait

  protected $table = 'Report'; //when using the Model trait, this table name ise used 
  protected $dateTimeColumn = 'submitTime';
  
  public function getAllReports($limit, $offset)
  {
    $query = "SELECT * FROM Report";

    return $this->query($query);
  }
}
