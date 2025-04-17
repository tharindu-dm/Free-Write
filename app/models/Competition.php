<?php

class Competition
{
    use Model;

    protected $table = 'Competition'; // Database table name

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

    // Update competition statuses based on dates
    public function updateCompetitionStatus()
    {
        $now = date('Y-m-d');
        $this->query("UPDATE $this->table SET status = 'active' WHERE start_date <= ? AND end_date >= ?", [$now, $now]);
        $this->query("UPDATE $this->table SET status = 'completed' WHERE end_date < ?", [$now]);
        $this->query("UPDATE $this->table SET status = 'upcoming' WHERE start_date > ?", [$now]);
    }

    public function where($conditions)
    {
        $query = "SELECT * FROM {$this->table} WHERE ";
        $params = [];
        foreach ($conditions as $key => $value) {
            $query .= "{$key} = :{$key} AND ";
            $params[":{$key}"] = $value;
        }
        $query = rtrim($query, ' AND ');

        return $this->query($query, $params)->fetchAll(PDO::FETCH_OBJ);
    }

        public function getAllCompetitions()
        {
            $query = "SELECT * FROM competitions";
            return $this->query($query);
        }
    
}

