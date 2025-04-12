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
    
    public function getCompetitionByWriterID($writerID)
    {
        $query = "SELECT * FROM Competition WHERE publisherID = :writerID";
        $params = [':writerID' => $writerID];
        return $this->query($query, $params);
    }

    public function getCompetitionByID($competitionID)
    {
        $query = "SELECT * FROM Competition WHERE competitionID = :competitionID";
        $params = [':competitionID' => $competitionID];
        return $this->query($query, $params);
    }
    
}
