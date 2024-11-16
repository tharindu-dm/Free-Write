<?php

class SpinOff
{
    use Model; // Use the Model trait

    protected $table = 'SpinOff'; //when using the Model trait, this table name ise used 

    public function getUserSpinoff($uid)
    {
        $query = "SELECT 
                s.[spinoffID], 
                s.title AS SpinoffName, 
                b.title AS BookTitle,
                COUNT(sc.chapter) AS SpinoffChapterCount,
                s.accessType AS AccessType
                FROM [dbo].[Spinoff] s
                JOIN [dbo].[Book] b ON s.fromBook = b.bookID
                LEFT JOIN  [dbo].[SpinoffChapter] sc ON s.spinoffID = sc.spinoff
                WHERE s.[creator] = 27
                GROUP BY s.[spinoffID], s.title, b.title, s.accessType
                ORDER BY  SpinoffName;";

        return $this->query($query);
    }

    public function getSpinoffDetails($spinoffID)
    {
        $query = "";

        return $this->query($query);
    }
}
