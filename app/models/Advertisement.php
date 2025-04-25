<?php

class Advertisement
{
    use Model; // Use the Model trait

    protected $table = 'Advertisement'; //when using the Model trait, this table name ise used 
    
    
    public function getLatestEndDate()
    {
        $query = "SELECT MAX(endDate) as latest_end_date FROM {$this->table}";
        $result = $this->query($query);
        
        if ($result && !empty($result[0])) {
            return $result[0]['latest_end_date'];
        }
        
        return null;
    }
    public function getAdIDwithinCurrentDateRange() {
        $query = "SELECT TOP 1 adID FROM [Advertisement] WHERE endDate >= GETDATE() AND startDate <= GETDATE()";
        return $this->query($query);
    }
    
    public function getAdIDExpired() {
        // This might have a syntax error
        $query = "SELECT adID FROM [Advertisement] WHERE endDate < GETDATE() AND (status = 'active' OR status = 'pending')";
        return $this->query($query);
    }
    
}
