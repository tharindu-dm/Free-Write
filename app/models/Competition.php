<?php
class Competition
{
    use Model;
    protected $table = 'Competition';

    public function findAll()
    {
        return $this->query("SELECT * FROM competitions");
    }

    public function updateCompetitionStatus()
    {
        $today = date('Y-m-d');

        // Set 'active' where current date is within start and end
        $this->query("UPDATE competitions SET status = 'active' WHERE start_date <= :today AND end_date >= :today", [
            'today' => $today
        ]);

        // Set 'previous' where end date is before today
        $this->query("UPDATE competitions SET status = 'previous' WHERE end_date < :today", [
            'today' => $today
        ]);

        // Set 'upcoming' where start date is after today
        $this->query("UPDATE competitions SET status = 'upcoming' WHERE start_date > :today", [
            'today' => $today
        ]);
    }
    
    
}
