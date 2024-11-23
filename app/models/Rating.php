<?php

class Rating
{
    use Model; // Use the Model trait

    protected $table = 'Rating'; //when using the Model trait, this table name ise used 

    public function getBookRating($bid)
    {
        $query = "SELECT CAST(AVG(rating)AS DECIMAL(4,2)) AS AverageRating, COUNT([user]) AS RatingCount
                 FROM [dbo].[Rating]
                WHERE book = $bid
                GROUP BY book;";

        return $this->query(query: $query);
    }

    public function updateRating($ratingValue, $book, $user)
    {
        $query = "UPDATE [Rating] SET [rating] = $ratingValue WHERE [book] = $book AND [user] = $user";

        return $this->query(query: $query);
    }
}
