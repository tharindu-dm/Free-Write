<?php

class BookChapter
{
    use Model; 

    protected $table = 'BookChapter'; 

    public function getChapters($bookID) 
    {
        $query = "SELECT bc.[chapter], ch.[title]
                    FROM [dbo].[BookChapter] bc 
                    JOIN [dbo].[Chapter] ch ON ch.chapterID=bc.chapter
                    WHERE [book]=$bookID ORDER BY chapter ASC OFFSET 1 ROWS";

        return $this->query($query);
    }

    public function getBookChapters($bid) 
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
