<?php

class DesignSubmissions
{
    use Model;

    protected $table = 'DesignSubmissions';

    public function createSubmission($data) {
        // Insert the submission data into the database
        return $this->insert($data);
    }

    public function getJoinedCompetitions($userID) {
        $query = "SELECT 
                    c.title AS competitionName,
                    ds.title AS submissionTitle,
                    ds.status,
                    ds.competitionID,
                    ds.submissionID,
                    ds.covID,
                    ds.created_at
                  FROM DesignSubmissions ds
                  JOIN Competition c ON ds.competitionID = c.competitionID
                  WHERE ds.userID = :userID";

        return $this->query($query, ['userID' => $userID]);
    }

    
}