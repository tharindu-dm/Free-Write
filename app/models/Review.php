<?php

class Review
{
    use Model; 

    protected $table = 'Review';  


    public function getReviews($bookID)
    {

        $query = "SELECT 
                    r.reviewID,
                    r.[user],
                    CONCAT(ud.firstName, ' ', ud.lastName) AS fullName,
                    r.content,
                    r.postDate
                FROM Review r
                JOIN [User] u ON r.[user] = u.[userID]
                JOIN UserDetails ud ON u.userID = ud.[user]
                WHERE r.book = $bookID
                AND u.isActivated != -1
                ORDER BY r.postDate DESC;";

        return $this->query($query);
    }
}
