<?php

class CovDesignRating
{
    use Model;

    protected $table = 'CovDesignRating';

    public function getAverageRating($covID)
    {
        $query = "SELECT AVG(rating) as averageRating, COUNT(userID) as totalUsers FROM {$this->table} WHERE covID = :covID";
        return $this->query($query, ['covID' => $covID])[0] ?? ['averageRating' => 0, 'tpatalUsers' => 0];
    }

    public function addOrUpdateRating($userID, $covID, $rating)
    {
        // Check if the user has already rated this design
        $existingRating = $this->query("SELECT * FROM {$this->table} WHERE userID = :userID AND covID = :covID", [
            'userID' => $userID,
            'covID' => $covID
        ]);

        if ($existingRating) {
            // Update the existing rating
            $query = "UPDATE {$this->table} SET rating = :rating WHERE userID = :userID AND covID = :covID";
        } else {
            // Insert a new rating
            $query = "INSERT INTO {$this->table} (userID, covID, rating) VALUES (:userID, :covID, :rating)";
        }

        return $this->query($query, [
            'userID' => $userID,
            'covID' => $covID,
            'rating' => $rating
        ]);
    }

}