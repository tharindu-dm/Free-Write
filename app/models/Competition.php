<?php
class Competition
{
    use Model;
    protected $table = 'Competition';

    public function updateCompetitionStatus()
    {
        $query = "UPDATE competition SET status = 'ended' WHERE end_date < GETDATE()";
        return $this->query($query);
    }
    
    
}
