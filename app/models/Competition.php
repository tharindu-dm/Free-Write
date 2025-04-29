<?php
class Competition
{
    use Model;
    protected $table = 'Competition';
    protected $dateTimeColumn = 'start_date';

    public function updateCompetitionStatus()
    {

        $now = date('Y-m-d');

        $this->query("UPDATE $this->table SET status = 'active' WHERE start_date <= ? AND end_date >= ?", [$now, $now]);

        $this->query("UPDATE $this->table SET status = 'completed' WHERE end_date < ?", [$now]);

        $this->query("UPDATE $this->table SET status = 'upcoming' WHERE start_date > ?", [$now]);

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

    public function findAll()
    {

        return $this->query("SELECT * FROM $this->table ORDER BY start_date ASC");

    }

    public function findByStatus($status)
    {

        return $this->query("SELECT * FROM $this->table WHERE status = ?", [$status]);

    }

    public function getAllCompetitions()
    {

        $query = "SELECT * FROM competitions";
        return $this->query($query);

    }

    public function getCompetitionDetails($type)
    {
        $query = "SELECT c.*,
                    CONCAT(u.[firstName], ' ', u.[lastName]) AS creatorFullName
                FROM [dbo].[Competition] c
                INNER JOIN [dbo].[UserDetails] u
                    ON c.[publisherID] = u.[user]
                WHERE c.[type] = '$type' AND c.[status] = 'active'";


        return $this->query($query);
    }
}
