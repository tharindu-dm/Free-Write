<?php

class BookGenre
{
    use Model; 

    protected $table = 'BookGenre'; 

    public function getGenreFrequency($userID)
    {
        $query = "SELECT 
            g.[name] AS genre_name,
            CAST(COUNT(bg.[genre]) AS FLOAT) / 
            (
                SELECT COUNT(*) 
                FROM [dbo].[BookGenre] bg2
                INNER JOIN [dbo].[BookList] bl2 ON bl2.[book] = bg2.[book]
                WHERE bl2.[user] = $userID
            ) * 100 AS percentage
        FROM [dbo].[BookGenre] bg
        INNER JOIN [dbo].[Genre] g ON bg.[genre] = g.[genreID]
        INNER JOIN [dbo].[BookList] bl ON bg.[book] = bl.[book]
        WHERE bl.[user] = $userID
        GROUP BY g.[name]
        ORDER BY percentage DESC;
    ";

        return $this->query($query);
    }


    public function getBookGenre($bid)
    {
        $query = "SELECT g.[name] AS genreName, g.[genreID] FROM [Genre] g
        JOIN [BookGenre] bg ON bg.[genre] = g.[genreID] 
        JOIN [Book] b ON bg.[book] = b.[bookID] 
        WHERE b.[bookID] = $bid;";

        return $this->query($query);
    }

    public function deleteBy($column, $value)
    {
        if (!$this->table) {
            return false;
        }

        $query = "DELETE FROM [{$this->table}] WHERE [$column] = :value";
        $data = [':value' => $value];

        if ($this->query($query, $data)) {
            return true;
        }
        return false;
    }

}