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
                WHERE s.[creator] = $uid
                GROUP BY s.[spinoffID], s.title, b.title, s.accessType
                ORDER BY  SpinoffName;";

        return $this->query($query);
    }

    public function getSpinoffDetails($spinoffID)
    {
        $query = "SELECT
                    s.[spinoffID],
                    s.[title],
                    c.title AS ChapterTitle,
                    s.isAcknowledge,
                    s.[synopsis],
                    s.[creator] AS [creatorID],
                    CONCAT(u.[firstName], ' ', u.[lastName]) AS [creator],
                    b.[title] AS [fromBook],
                    b.bookID,
                    s.[accessType],
                    s.[lastUpdated]
                    FROM [dbo].[Spinoff] s
                    JOIN [dbo].[UserDetails] u ON s.[creator] = u.[user] 
                    LEFT JOIN [dbo].[Chapter] c ON s.startingChapter = c.chapterID
                    JOIN [dbo].[Book] b ON s.[fromBook] = b.[bookID] WHERE s.[spinoffID] = $spinoffID;";

        return $this->query($query);
    }
    public function getPendingSpinoff($uid)
    {
        $query = "SELECT 
                s.[spinoffID], 
                s.title AS SpinoffTitle, 
                b.title AS BookTitle,
                c.title AS ChapterTitle,
                s.synopsis, s.lastUpdated
                FROM [dbo].[Spinoff] s
                JOIN [dbo].[Book] b ON s.fromBook = b.bookID
                LEFT JOIN [dbo].[Chapter] c ON s.startingChapter = c.chapterID
                WHERE (b.[author] = $uid
                AND s.[isAcknowledge] = 0)";

        return $this->query($query);
    }
    public function getAcceptedSpinoff($uid)
    {
        $query = "SELECT 
                s.[spinoffID], 
                s.title AS SpinoffTitle, 
                b.title AS BookTitle,
                c.title AS ChapterTitle,
                s.synopsis, s.lastUpdated
                FROM [dbo].[Spinoff] s
                JOIN [dbo].[Book] b ON s.fromBook = b.bookID
                LEFT JOIN [dbo].[Chapter] c ON s.startingChapter = c.chapterID
                WHERE (b.[author] = $uid
                AND s.[isAcknowledge] = 1)";

        return $this->query($query);
    }

    public function getRejectedSpinoff($uid)
    {
        $query = "SELECT 
                s.[spinoffID], 
                s.title AS SpinoffTitle, 
                b.title AS BookTitle,
                c.title AS ChapterTitle,
                s.synopsis, s.lastUpdated
                FROM [dbo].[Spinoff] s
                JOIN [dbo].[Book] b ON s.fromBook = b.bookID
                LEFT JOIN [dbo].[Chapter] c ON s.startingChapter = c.chapterID
                WHERE (b.[author] = $uid
                AND s.[isAcknowledge] = 2)";

        return $this->query($query);
    }
}
