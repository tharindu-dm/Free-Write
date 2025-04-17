<?php
class Competition
{
    use Model;
    protected $table = 'Competition';

    // Update competition statuses based on dates
    public function updateCompetitionStatus()
    {

        $now = date('Y-m-d');

        $this->query("UPDATE $this->table SET status = 'active' WHERE start_date <= ? AND end_date >= ?", [$now, $now]);

        $this->query("UPDATE $this->table SET status = 'completed' WHERE end_date < ?", [$now]);

        $this->query("UPDATE $this->table SET status = 'upcoming' WHERE start_date > ?", [$now]);

    }

    /*public function updateCompetitionStatus()
    {
        $query = "UPDATE competition SET status = 'ended' WHERE end_date < GETDATE()";
        return $this->query($query);
    }
    */
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

    //nalan addition
    // Fetch all competitions
    public function findAll()
    {

        return $this->query("SELECT * FROM $this->table ORDER BY start_date ASC");

    }

    // Fetch competitions by status
    public function findByStatus($status)
    {

        return $this->query("SELECT * FROM $this->table WHERE status = ?", [$status]);

    }

    //public function where($conditions)
    //{
    //
    //$query = "SELECT * FROM {$this->table} WHERE ";
    //$params = [];
    //
    //foreach ($conditions as $key => $value) {
    //
    //$query .= "{$key} = :{$key} AND ";
    //$params[":{$key}"] = $value;
    //
    //}
    //
    //$query = rtrim($query, ' AND ');
    //
    //return $this->query($query, $params)->fetchAll(PDO::FETCH_OBJ);
    //
    //}

    public function getAllCompetitions()
    {

        $query = "SELECT * FROM competitions";
        return $this->query($query);

    }
}
