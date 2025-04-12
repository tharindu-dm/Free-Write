<?php

class BookGenre
{
    use Model; // Use the Model trait

    protected $table = 'BookGenre'; //when using the Model trait, this table name ise used 

    public function getGenreFrequency($userID)
    {
        $query = "SELECT 
                    g.[name] AS genre_name,

                    CAST(COUNT(bg.[genre]) AS FLOAT) / (SELECT COUNT(*) FROM [dbo].[BookList] bl WHERE bl.[user] = $userID) * 100 AS percentage

                    FROM [dbo].[BookGenre] bg
                    INNER JOIN [dbo].[Genre] g ON bg.[genre] = g.[genreID]
                    WHERE bg.[book] IN (
                    SELECT bl.[book]
                    FROM [dbo].[BookList] bl
                    WHERE bl.[user] = $userID
                    )
                    GROUP BY g.[name]
                    ORDER BY percentage DESC;";

        return $this->query($query);
    }

}
