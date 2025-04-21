<?php

class BookChapter
{
    use Model; // Use the Model trait

    protected $table = 'BookChapter'; //when using the Model trait, this table name ise used 

    public function getChapters($bookID) //when creating new spinoff need to block the first chapter from using
    {
        $query = "SELECT bc.[chapter], ch.[title]
                    FROM [dbo].[BookChapter] bc 
                    JOIN [dbo].[Chapter] ch ON ch.chapterID=bc.chapter
                    WHERE [book]=$bookID ORDER BY chapter ASC OFFSET 1 ROWS";

        return $this->query($query);
    }

    public function getBookChapters($bid) //to the book Overview
    {
        $query = "SELECT C.[chapterID],C.[title], C.[lastUpdated], C.price
        FROM [dbo].[BookChapter] BC 
        JOIN [dbo].[Chapter] C ON BC.[chapter] = C.[chapterID] 
        WHERE BC.[book] = $bid 
        ORDER BY C.[chapterID] ASC;";

        return $this->query($query);
    }

    public function getChapterCount($bid)
    {
        $query = "SELECT COUNT(*) AS ChapterCount
                FROM [dbo].[BookChapter]
                WHERE [book] = $bid;";

        return $this->query($query)[0];
    }
}
