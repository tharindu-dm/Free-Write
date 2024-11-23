<?php

class Rating
{
    use Model; // Use the Model trait

    protected $table = 'Rating'; //when using the Model trait, this table name ise used 

    public function getBookRating($bid)
    {
        $query = "SELECT AVG(rating) AS AverageRating
                FROM [dbo].[Rating]
                WHERE book = $bid
                GROUP BY book;";

        return $this->query(query: $query);
    }
}
